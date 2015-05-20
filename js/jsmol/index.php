<html>
<head>
<script type="text/javascript" src=js/JSmol.full.js></script>
<script type="text/javascript" src=js/Jmol2.js></script>
<script type="text/javascript">

jmolInitialize(".")

function callback(a,b) {
 document.title=[a,b,b.charCodeAt(8)]
 return b
}

function sync() {
 var syncing = document.getElementById("drive").checked
 var s = (syncing ? 'sync * on;sync * "set syncMouse on;set syncScript off";sync jmolAppletC SLAVE;sync jmolAppletD SLAVE': 'sync * off')
 jmolScript(s, "A");
}

function syncAll() {
 var s = 'sync *;set syncScript true;sync * "reset";'
 jmolScript(s, "A");
 sync();
}

function sync2() {
 var syncing = document.getElementById("drive").checked
 var s = (syncing ? 'sync * off;sync . on;sync jmolAppletB on;sync jmolAppletB "set syncMouse on;set syncScript off";': 'sync * off')
 jmolScript(s, "A");
}


function doLoad() {
 document.getElementById("info").reset()
}

</script>
</head>
<body onload = doLoad()>

<table border = 1 cellpadding=40>
<tr>

<td id=tdA> 
<!--<script>jmolApplet(400,"load ../../proteinModels/<?php echo $_GET['pdb']?>;cartoon only;color cartoon structure;");</script>-->
<script>jmolApplet(400,"load ../../proteinModels/cx39/AA_HC_CX39.pdb;cartoon only;color cartoon structure;");</script>
</td>
</tr>

</table>
<form id=info>
 <a href=javascript:syncAll()>reset</a>
</form>

</body>
</html>