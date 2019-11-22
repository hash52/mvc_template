<?php
/* Smarty version 3.1.33, created on 2019-11-22 05:20:01
  from '/Users/HirokiHashi/workspace/php/mvc_template/public_html/sample/views/templates/hogeview.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5dd761f17e13e2_26533035',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '6e3c3dfa6dd09b999a0b1a61a2a2ea2012fd3d46' => 
    array (
      0 => '/Users/HirokiHashi/workspace/php/mvc_template/public_html/sample/views/templates/hogeview.html',
      1 => 1574396239,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5dd761f17e13e2_26533035 (Smarty_Internal_Template $_smarty_tpl) {
?><html>
  <head>
    <meta charset="utf-8" />
  </head>
  <body>

    <?php echo $_smarty_tpl->tpl_vars['hello']->value;?>
, <?php echo $_smarty_tpl->tpl_vars['name']->value;?>


    <ul>
      <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['logs']->value, 'log');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['log']->value) {
?>
        <li><?php echo $_smarty_tpl->tpl_vars['log']->value;?>
</li>
      <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    </ul>

  </body>
</html>
<?php }
}
