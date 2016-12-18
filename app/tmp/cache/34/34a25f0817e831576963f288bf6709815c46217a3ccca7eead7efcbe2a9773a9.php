<?php

/* users/list.twig */
class __TwigTemplate_82402b990fac15b8837d8caed28e242f5042a2e0914c5527a340706b84d776c7 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("templates/app.twig", "users/list.twig", 1);
        $this->blocks = array(
            'content' => array($this, 'block_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "templates/app.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_content($context, array $blocks = array())
    {
        // line 4
        echo "    <div class=\"row\">
    \t<div class=\"\">
    \t\t<div class=\"panel panel-default\">
    \t\t\t<div class=\"panel-heading\">Liste des utilisateurs</div>
    \t\t\t<div class=\"panel-body\" style=\"padding:0;\">
    \t\t\t\t<form action=\"";
        // line 9
        echo twig_escape_filter($this->env, $this->env->getExtension('Slim\Views\TwigExtension')->pathFor("users.setlist"), "html", null, true);
        echo "\" method=\"post\">
\t\t\t\t\t\t
\t\t\t\t\t\t<div style=\"display:none;\"><button type=\"submit\" class=\"btn btn-primary\" style=\"width:100%;\">Sauvegarder les modifications</button></div>
\t\t\t\t\t\t<div id=\"users-grid\" data-ax5grid=\"users-grid\" data-ax5grid-config=\"{}\" style=\"height: 600px; width: 100%;\"></div>
\t\t\t\t\t\t<div style=\"padding: 10px;\">
\t\t\t\t\t\t\t<button type=\"button\" class=\"btn btn-default\" data-grid-control=\"excel-export\">Export Excel</button>
\t\t\t\t\t\t</div>
\t\t\t\t\t\t
                        ";
        // line 17
        echo $this->getAttribute((isset($context["csrf"]) ? $context["csrf"] : null), "field", array());
        echo "
    \t\t\t\t</form>
    \t\t\t</div>
\t\t\t\t<script>
\t\t\t\t\t\$(document.body).ready(function () {
\t\t\t\t\t\tvar usersData = ";
        // line 22
        echo (isset($context["usersData"]) ? $context["usersData"] : null);
        echo ";
\t\t\t\t\t\t
\t\t\t\t\t\tvar usersGrid = new ax5.ui.grid({
\t\t\t\t\t\t\ttarget: \$('[data-ax5grid=\"users-grid\"]'),
\t\t\t\t\t\t\tcolumns: [
\t\t\t\t\t\t\t\t{key: \"email\", label: \"Email\", align: \"left\", editor: {type: \"text\"}},
\t\t\t\t\t\t\t\t{key: \"id\", label: \"Mot de passe\", align: \"center\", editor: {type: \"text\"}},
\t\t\t\t\t\t\t\t{key: \"name\", label: \"Nom\", align: \"left\", editor: {type: \"text\"}},
\t\t\t\t\t\t\t\t{key: \"surname\", label: \"Prenom\", align: \"left\", editor: {type: \"text\"}},
\t\t\t\t\t\t\t\t{key: \"telnumber\", label: \"Numéro de téléphone\", editor: {type: \"text\"}},
\t\t\t\t\t\t\t\t/* conflit si on met styleClass:\"mask-telfr\", voir pour desactiver formater ax5 sur cette colonne  */
\t\t\t\t\t\t\t\t{key: \"is_admin\", label: \"Administrateur\", editor: {
\t\t\t\t\t\t\t\t\ttype: \"select\", 
\t\t\t\t\t\t\t\t\t\tconfig: {
\t\t\t\t\t\t\t\t\t\t\tcolumnKeys: {optionValue: \"V\", optionText: \"T\"},
\t\t\t\t\t\t\t\t\t\t\toptions: [{V: \"1\", T: \"Oui\"},{V: \"0\", T: \"Non\"}]
\t\t\t\t\t\t\t\t\t\t}
\t\t\t\t\t\t\t\t\t}
\t\t\t\t\t\t\t\t},
\t\t\t\t\t\t\t\t{key: \"created_at\", label: \"Date de création\", align: \"center\"},
\t\t\t\t\t\t\t\t{key: \"updated_at\", label: \"Dernière modification\", align: \"center\"}
\t\t\t\t\t\t\t\t
\t\t\t\t\t\t\t]
\t\t\t\t\t\t});
\t\t\t\t\t\t
\t\t\t\t\t\tconsole.log(usersData);
\t\t\t\t\t\t//usersGrid.setData(usersData); //NOT OK
\t\t\t\t\t\t
\t\t\t\t\t\t
\t\t\t\t\t\tusersGrid.setHeight(height);
\t\t\t\t\t\t
\t\t\t\t\t\tvar list = [];
\t\t\t\t\t\tfor (var a = 0, l = 100; a < l; a++) {
\t\t\t\t\t\t\tlist.push({\temail: \"A value\", 
\t\t\t\t\t\t\t\t\t\tid: \"B value\",
\t\t\t\t\t\t\t\t\t\tname: \"ee\", 
\t\t\t\t\t\t\t\t\t\tsurname: \"D value\",
\t\t\t\t\t\t\t\t\t\ttelnumber: \"02156456\",
\t\t\t\t\t\t\t\t\t\tis_admin: \"1\",
\t\t\t\t\t\t\t\t\t\tcreated_at: \"C value\",
\t\t\t\t\t\t\t\t\t\tupdated_at: \"U value\"
\t\t\t\t\t\t\t\t\t});
\t\t\t\t\t\t}
\t\t\t\t\t\tusersGrid.setData(list);
\t\t\t\t\t\t
\t\t\t\t\t\t
\t\t\t\t\t\t// grid control button
\t\t\t\t\t\t\$('[data-grid-control]').click(function () {
\t\t\t\t\t\t\tvar txtdate = ax5.util.date(new Date(), {'return':'yyyyMMdd'});
\t\t\t\t\t\t\tusersGrid.exportExcel(\"liste-utilisateurs-\"+ txtdate +\".xls\");
\t\t\t\t\t\t});
\t\t\t\t\t\t
\t\t\t\t\t});
\t\t\t\t</script>
    \t\t</div>
    \t</div>
    </div>
";
    }

    public function getTemplateName()
    {
        return "users/list.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  57 => 22,  49 => 17,  38 => 9,  31 => 4,  28 => 3,  11 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "users/list.twig", "D:\\DEV_TOOLS\\wamp64\\www\\authentification\\resources\\views\\users\\list.twig");
    }
}
