
<footer>
    <small>&copy; Copyright / <span><a href="<{site_url()}>"><{config_item('site_name')}></a></span> / <a class="italic" href="<{site_url('privacy')}>#remerciements">Remerciements</a> - <a class="italic" href="<{site_url("privacy")}>#privacy">Règles de confidentialité</a> - <a class="italic" href="<{site_url("contact")}>">Nous contacter</a>.</small>
</footer>

<script src="<{assets('vendor/jquery/dist/jquery.min.js')}>"></script>
<{block name="scripts"}><{/block}>
<script src="<{assets('js/scripts.js')}>"></script>

<{if $member->town != "" && $member->agency_name != ""}>
    <script>
        var city = "<{$member->town}>";
        AgencyMap(city);
    </script>      
<{/if}>
<{block name="js"}><{/block}>
</body>
</html>