<html>
<head>
<script type="text/javascript" src=js/JSmol.full.js></script>
<script type="text/javascript" src=js/Jmol2.js></script>
<script type="text/javascript">

jmolInitialize(".")

function doLoad() {
// document.getElementById("info").reset();
setTimeout(function(){ document.getElementById("warning").hidden=true; }, 2000);
}

</script>
</head>
<body onload = doLoad()>

<!--<table border = 1 cellpadding=40>-->
<!--<tr>-->
<!--<td id=tdA>-->
<script>
    var pdb="<?php echo $_GET['pdb']?>",surface="";
//    if((pdb+'').includes('lipids')||pdb.includes('solvate'))
    if((pdb+'').indexOf('lipids')>-1||pdb.indexOf('solvate')>-1)
    {
        surface="isosurface vdw translucent";
//        document.writeln("This could take some minute to load and may crush your browser.");
//        document.getElementById("warning").hidden=false;
    }
//    alert("XD pdb:"+pdb);
    jmolApplet(400,"load ../../proteinModels/"+pdb+";set antialiasDisplay false;set platformSpeed 1;cartoon only;color cartoon structure;"+surface);
</script>
<div id='warning' ><img src="../../css/images/ajax-loader.gif" alt="Searching" />This could take some minute to load and may freeze your browser. Please wait.</div>
<!--<script>jmolApplet(400,"load ../../proteinModels/cx39/AA_HC_CX39.pdb;cartoon only;color cartoon structure;");</script>-->
<!--</td>-->
<!--</tr>-->

<!--</table>-->
<!--<form id=info>-->
<!-- <a href=javascript:doLoad()>reset</a>-->
 
<!--</form>-->

</body>
</html>