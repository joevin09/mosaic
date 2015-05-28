<?php

class MY_Modules {

    private $CI;
    private $modules = array();
    private $modules_names = array();
    private $module = array();
    private $admin;

    public static function get_instance() {
        static $instance;
        $class = __CLASS__;
        if (!$instance instanceof $class) {
            $instance = new $class;
        }
        return $instance;
    }

    public function __construct() {
        $this->CI = & get_instance();
        $this->admin = $this->CI->data['admin'];
        $this->_fetch_modules();
    }

    public function _fetch_modules() {
        $this->CI->load->model('admin_modules_model');
        $modules = $this->CI->admin_modules_model->get();
        $this->modules = $children = array();
        // Get all modules
        foreach ($modules AS $v) {
            $this->modules_names[str_replace('-', '_', strtolower($v->name))] = $v->id;
            if ($v->id_parent > 0) {
                $children[$v->id_parent][] = $v;
            } else {
                $this->modules[] = $v;
            }
            // Get current module
            if (str_replace('-', '_', strtolower($v->name)) == strtolower($this->CI->router->fetch_class())) {
                $this->module = $v;
            }
        }
        // Set children to their parent
        foreach ($this->modules AS $k => $v) {
            if (!empty($children[$v->id])) {
                if ($v->type == "link") {
                    $this->modules[$k]->subnav = $children[$v->id];
                } else {
                    $this->modules[$k]->nav = $children[$v->id];
                }
            }
        }
        $this->CI->data['modules'] = $this->modules;
        $this->CI->data['module'] = $this->module;
    }

    public function display_modules_menu($modules = "") {
        $open_list = FALSE;
        if (empty($modules)) {
            $open_list = TRUE;
            $modules = $this->modules;
        }
        if (empty($modules)) {
            return FALSE;
        }
        foreach ($modules AS $v) {
            if ($this->user_can('view', $v->id) && $v->visible) {
                if ($v->type == "separator") {
                    $this->display_separator($v);
                } else if (!empty($v->subnav)) {
                    $this->display_subnav($v);
                } else {
                    $this->display_link($v, $open_list);
                }
            }
        }
    }

    private function display_separator($v) {
        echo '<div class="nav-sidebar title"><span>' . $v->title . '</span></div>';
        echo '<ul class="nav nav-sidebar">';
        if ($v->nav) {
            $this->display_modules_menu($v->nav);
        }
        echo '</ul>';
    }

    private function display_link($v, $open_list = FALSE) {
        if ($open_list) {
            echo '<ul class="nav nav-sidebar">';
        }
        $active = ($this->module->id_parent == $v->id || $this->module->id == $v->id) ? ' class="active open"' : '';
        $active_class = ($active) ? "active" : "";
        if (!empty($active)) {
            $active = ' class="active"';
        }
        echo '<li' . $active . '>
                        <a href="' . site_url($v->name, FALSE) . '"' . $active . '>';
        $this->display_icon($v->icon);
        echo '<span class="hidden-sm text">' . $v->title . '</span></a>
                        </li>';
        if ($open_list) {
            echo '</ul>';
        }
    }

    private function display_subnav($v) {
        echo '<li' . $active . '>
                        <a href="#" class="dropmenu">';
        $this->display_icon($v->icon);
        echo '<span>' . $v->title . '</span><b class="arrow icon-angle-down"></b></a>
                        <ul class="submenu">';
        foreach ($v->subnav AS $vv) {
            $subActive = ($this->module->id == $vv->id) ? ' class="active"' : '';
            if (!empty($vv->subnav)) {
                echo '<ul class="unstyled">' . $vv->name . '';
                $this->display_modules_menu($vv->subnav);
                echo '</ul>';
            } else if ($this->user_can('view', $vv->id) && $vv->visible) {
                echo '<li' . $subActive . '>
                                <a href="' . site_url($vv->name, FALSE) . '">';
                $this->display_icon($v->icon);
                echo '<span>' . $vv->title . '</span></a>
                            </li>';
            }
        }
        echo '</ul>';
    }

    public function display_icon($icon) {
        if (!empty($icon) && preg_match('/^fa/', $icon)) {
            echo '<i class="fa ' . $icon . '"></i> ';
        } else if (!empty($icon)) {
            echo '<i class="fa fa-' . $icon . '"></i> ';
        }
    }

    public function display_breadcrumb() {

        if ($this->CI->router->fetch_class() == "home") {
            echo '<li>Home</li>';
        } else {
            echo '<li><a href="' . site_url('', FALSE) . '">Home</a></li>';
        }
        echo '<li>';
        if ($this->CI->router->fetch_method() != "index") {
            echo '<a href="' . site_url($this->CI->router->fetch_class(), FALSE) . '">' . $this->module->title . '</a>';
            if ($this->CI->router->fetch_method() == "add") {
                echo '<li>Formulaire d\'ajout</li>';
            } else if ($this->CI->router->fetch_method() == "edit") {
                echo '<li>Formulaire de modification</li>';
            }
        } else {
            echo $this->module->title;
        }
        echo '</li>';
    }

    public function page_title($page_name = "") {
        if (empty($page_name)) {
            $page_name = $this->CI->router->fetch_class();
            $module = $this->module;
        } else {
            $this->CI->load->model('modules_model');
            $w = array(
                'where' => array(
                    'name' => $page_name,
                ),
            );
            $module = $this->CI->modules_model->get_row($w);
        }
        return (!empty($module)) ? $module->title : '';
    }

    public function user_can($type = "view", $module = "") {

        if (!$this->admin->perms) {
            return FALSE;
        }
        if (empty($module)) {
            $module = $this->module->id;
        }
        // Get ID module
        if (!is_numeric($module)) {
            $module = str_replace('-', '_', $module);
            if (!$this->modules_names[$module]) {
                die("Le module &laquo; " . $module . " &raquo; n'existe pas.");
            } else {
                $module = $this->modules_names[$module];
            }
        }
        // Check if user can view/add/edit/delete this module
        return (array_key_exists($module, $this->admin->perms) && array_key_exists($type, $this->admin->perms[$module]));
    }

    public function display_modules_select($modules = "", $iteration = -1) {
        $iteration++;

        if (empty($modules)) {
            $modules = $this->modules;
        }
        foreach ($modules AS $v) {
            $selected = ($this->CI->input->post('id_parent') == $v->id) ? ' class="selected" ' : '';
            $prefix = "";
            if ($iteration > 0) {
                for ($i = 0; $i < $iteration; $i++) {
                    $prefix .= "---";
                }
            } else {
                $prefix = "+";
            }
            echo '<option value="' . $v->id . '"' . $selected . '>' . $prefix . ' ' . $v->title . '</option>';
            if (!empty($v->subnav)) {
                $this->display_modules_select($v->subnav, $iteration);
            }
        }
    }

    public function display_user_group_modules_select($modules = "", $iteration = -1, $select = "") {
        $iteration++;

        if (empty($modules)) {
            $modules = $this->modules;
        }
        foreach ($modules AS $v) {
            $selected = ($select == $v->name) ? ' selected="selected" ' : '';
            $prefix = "";
            if ($iteration > 0) {
                for ($i = 0; $i < $iteration; $i++) {
                    $prefix .= "---";
                }
            } else {
                $prefix = "+";
            }
            echo '<option value="' . $v->name . '"' . $selected . '>' . $prefix . ' ' . $v->title . '</option>';
            if (!empty($v->subnav)) {
                $this->display_user_group_modules_select($v->subnav, $iteration, $select);
            } else if (!empty($v->nav)) {
                $this->display_user_group_modules_select($v->nav, $iteration, $select);
            }
        }
    }

    public function display_modules_list($modules = "") {

        if (empty($modules)) {
            $modules = $this->modules;
        }
        echo '<ol class="dd-list table-list">';
        foreach ($modules AS $v) {
            echo '<li class="dd-item dd3-item" data-id="' . $v->id . '">';
            echo '<div class="dd-handle dd3-handle">';
            $this->display_icon($v->icon);
            echo '</div>';
            echo '<div class="dd3-content">' . $v->title . ' <small> ' . $v->name . '</small>';
            echo '<span class="pull-right">';
            if ($this->user_can('edit') && $this->admin->id_role == 1) {
                echo '<a href="' . site_url(array($this->CI->router->fetch_class(), 'edit', $v->id)) . '" class="btn btn-xs btn-info" data-rel="tooltip" title="Modifier">
                            <i class="fa fa-edit"></i>
                        </a> ';
            }
            if ($this->user_can('delete') && $this->admin->id_role == 1) {
                echo '<a href="' . site_url(array($this->CI->router->fetch_class(), 'delete', $v->id)) . '" class="action-delete btn btn-xs btn-danger" data-rel="tooltip" title="Supprimer">
                                <i class="fa fa-trash-o"></i>
                            </a> ';
            }
            echo '</span>';
            echo '</div>';
            if (!empty($v->subnav)) {
                $this->display_modules_list($v->subnav);
            } else if (!empty($v->nav)) {
                $this->display_modules_list($v->nav);
            }
            echo'</li>';
        }

        echo '</ol>';
    }

    public function hasChildren($id_module) {

        $p = array(
            'where' => array(
                'id_parent' => $id_module,
            ),
        );
        $children = $this->CI->admin_modules_model->get($p);
        return count($children);
    }

}

if (!function_exists('user_can')) {

    function user_can($type, $module = "") {
        $modules_class = MY_Modules::get_instance();
        return $modules_class->user_can($type, $module);
    }

}

if (!function_exists('display_breadcrumb')) {

    function display_breadcrumb() {
        $modules_class = MY_Modules::get_instance();
        return $modules_class->display_breadcrumb();
    }

}

if (!function_exists('display_modules_menu')) {

    function display_modules_menu($modules = "") {
        $modules_class = MY_Modules::get_instance();
        return $modules_class->display_modules_menu($modules);
    }

}

if (!function_exists('display_modules_list')) {

    function display_modules_list($modules = "") {
        $modules_class = MY_Modules::get_instance();
        return $modules_class->display_modules_list($modules);
    }

}

if (!function_exists('display_user_group_modules_select')) {

    function display_user_group_modules_select($modules = "", $iteration = -1, $select = "") {
        $modules_class = MY_Modules::get_instance();
        return $modules_class->display_user_group_modules_select($modules, $iteration, $select);
    }

}

if (!function_exists('hasChildren')) {

    function hasChildren($id_module) {
        $modules_class = MY_Modules::get_instance();
        return $modules_class->hasChildren($id_module);
    }

}
