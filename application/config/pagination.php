<?php

$ci = & get_instance();
$config['base_url'] = site_url(array($ci->router->fetch_class(), 'page'), FALSE);

$config['num_links'] = 10;
$config['uri_segment'] = 2;
$config['use_page_numbers'] = true;

$config['full_tag_open'] = '<div class="text-center"><ul class="pagination">';
$config['full_tag_close'] = '</ul></div>';

$config['num_tag_open'] = '<li>';
$config['num_tag_close'] = '</li>';

//$config['first_link'] = '< First';
$config['first_tag_open'] = '<li>';
$config['first_tag_close'] = '</li>';

//$config['last_link'] = 'Last >';
$config['last_tag_open'] = '<li>';
$config['last_tag_close'] = '</li>';

$config['next_link'] = '&raquo;';
$config['next_tag_open'] = '<li class="next-page">';
$config['next_tag_close'] = '</li>';

$config['prev_link'] = '&laquo;';
$config['prev_tag_open'] = '<li class="prev-page">';
$config['prev_tag_close'] = '</li>';

$config['cur_tag_open'] = '<li class="active"><a href="">';
$config['cur_tag_close'] = '</a></li>';

$config['enable_query_strings'] = TRUE;

if (!empty($_GET)) {
    $config['suffix'] = '?' . http_build_query($_GET, '', "&");
    $config['first_url'] = $config['base_url'] . $config['suffix'];
}