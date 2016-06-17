<script type="text/javascript">
$("select#example-04").jgdDropdown({clsLIPrefix: 'flag ', cls: 'jgd-dropdown jgd-countries', callback: function(obj, val) {window.location = "<?=$_SERVER["PHP_SELF"]?>?lang="+val; }, selected: '<?=$_SESSION["lang"]?>'});
</script>
</body>
</html>
