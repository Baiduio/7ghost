<?php if (PHP_VERSION_OLD): ?>
<div style="background-color: #ffcccc; padding: 10px; margin-bottom: 20px; border: 1px solid #ff6666;">
    <strong>警告：</strong>您的 PHP 版本过低（当前版本：<?php echo PHP_VERSION; ?>），该项目需要 PHP 8.1 或更高版本。请升级您的 PHP 版本以获得最佳性能和安全性。
</div>
<?php endif; ?>
<form action="" method="post">
<table cellspacing="0">
<tbody>
<!--
<tr><th>用户名</th><td><input name="username" value="">
</td></tr>
-->
<tr><th>密码：</th><td><input type="password" name="password"><input type="submit" value="登录">
</td></tr>
</tbody></table>
	<!--
<p><input type="submit" value="登录">
</p><div></div>
-->
</form>