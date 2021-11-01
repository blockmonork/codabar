<?php

// --- gerador de codigos de barra tipo CodaBar

function get_codabar($code, $path_to_file = '') // path COM barra final
{
   $d = 'CodaBar2/';
   $abre = '<img src="' . $path_to_file . $d . 'cab_a.png" border="0" />';
   $fecha = '<img src="' . $path_to_file . $d . 'cab_z.png" border="0" />';
   $tag = '<img src="' . $path_to_file . $d . '%s" border="0" />';
   $src = $ret = '';
   for ($i = 0; $i < strlen($code); $i++) {
      $p = $code[$i];
      $src = '0_' . $p . '.png';
      $ret .= sprintf($tag, $src);
   }
   return $abre . $ret . $fecha;
}

// ------- testando

if (!$_POST) {
   $tela = '<form action=""method="post" onsubmit="return validar();">
        <input type="text" name="vlr" id="vlr" ><br>
        <input type="submit" value="gerar">
   </form>';
} else {
   $num = trim($_POST['vlr']);
   $tela = '<p align="center">codigo de barras CodaBar<br>' . get_codabar($num) . '
      <br>' . $num . ' <br>
      <a href="' . $_SERVER['PHP_SELF'] . '">Reset</a>
      </p>';
}
// '<br> link pra codaBar -> http://www.barcodeisland.com/codabar.phtml';
?>
<html>

<head>
   <script type="text/javascript">
      function erro(m) {
         document.getElementById("p").innerHTML = m;
      }

      function validar() {
         var f = document.forms[0];
         if (f.vlr.value == '') {
            erro('vlr vazio');
            return false;
         }
         if (isNaN(f.vlr.value)) {
            erro('somente numero');
            return false;
         }
         return true;
      }

      function fcs() {
         if (document.getElementById('vlr') != undefined) {
            document.getElementById('vlr').focus();
         }
      }
   </script>
</head>

<body onload="fcs();">
   <?php echo $tela; ?>
   <br>
   <div id="p"></div>
</body>

</html>