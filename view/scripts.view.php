<!-- jQuery 2.2.3 -->
<script src="../util/plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="../util/bootstrap/js/bootstrap.min.js"></script>

<!-- DATA TABLE -->
<script src="../util/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
<script src="../util/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>

<!-- SlimScroll -->
<script src="../util/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="../util/plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../util/lte/js/app.min.js"></script>

<!-- AdminLTE for demo purposes -->
<script src="../util/lte/js/demo.js"></script>

<!--sweetalert-->
<script src="../util/plugins/swa/sweetalert-dev.js"></script>

<!--Bootstrap WYSIHTML5 -->
<script src="../util/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>

<!--  CK Editor -->
<script src="../util/plugins/ckeditor/ckeditor.js"></script>
<!--<script src="../../bower_components/ckeditor/ckeditor.js"></script>-->

<!--<script src="../util/js/jquery-3.2.1.min.js" type="text/javascript"></script>-->
<script src="../util/js/timer.jquery.min.js" type="text/javascript"></script>

<!--<script src="../util/lte/js/pages/dashboard2.js"></script>-->
<!--<script src="../util/lte/js/pages/dashboard.js"></script>-->

<script src="../util/plugins/chartjs/Chart.js"></script>

<!--<script>
    (function(){
        $('.start-timer-btn').on('click', function(){
            $('.timer').timer();
        });
        
    })();
</script>-->

<!--
 jQuery 3 
<script src="../../bower_components/jquery/dist/jquery.min.js"></script>
 Bootstrap 3.3.7 
<script src="../../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
 FastClick 
<script src="../../bower_components/fastclick/lib/fastclick.js"></script>
 AdminLTE App 
<script src="../../dist/js/adminlte.min.js"></script>
 AdminLTE for demo purposes 
<script src="../../dist/js/demo.js"></script>

 -->
 
 <script>
                function ValidaSoloNumeros() {/* no permite el ingreso de carÃ¡cteres que no sean numeros*/
                if ((event.keyCode < 48) || (event.keyCode/* cÃ³digo de la tecla fÃ­sica*/ > 57)) /* del 48 al 56 corresponde solo numeros*/
                event.returnValue = false;
            }
</script>
<script>
    /*
    function mostrarC() {
        document.getElementById('contenido').style.display = 'block';
        document.getElementById('simulador').style.display = 'none';
        document.getElementById('img_curso').style.display = 'none';

    }
    */
    function mostrarS() {
        document.getElementById('contenido').style.display = 'none';
        document.getElementById('simulador').style.display = 'block';
        document.getElementById('img_curso').style.display = 'none';

    }

</script>

<script>
            function mostrar(id) {

                if (id == "alternativa1") {
                    $("#alternativa1").show();
                    $("#alternativa2").hide();
                    $("#alternativa3").hide();
                    $("#alternativa4").hide();
                }   
                if (id == "alternativa2") {
                    $("#alternativa1").show();
                    $("#alternativa2").show();
                    $("#alternativa3").hide();
                    $("#alternativa4").hide();
                }    
                if (id == "alternativa3") {
                    $("#alternativa1").show();
                    $("#alternativa2").show();
                    $("#alternativa3").show();
                    $("#alternativa4").hide();
                }    
                if (id == "alternativa4") {
                    $("#alternativa1").show();
                    $("#alternativa2").show();
                    $("#alternativa3").show();
                    $("#alternativa4").show();
                }
                if (id == "0") {
                    $("#alternativa1").hide();
                    $("#alternativa2").hide();
                    $("#alternativa3").hide();
                    $("#alternativa4").hide();
                }             

            }
</script>
<script>
            function mostrarAddCurso(id) {

                if (id == "S") {
                    $("#curso").show();
                }else{
                    $("#curso").hide();
                }  
            }
</script>
