        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="../_include/js/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="../_include/js/jquery.min.js"><\/script>')</script>
        <link rel="stylesheet" type="text/css" href="../_include/css/jquery.datetimepicker.min.css"/>
        <script src="../_include/js/jquery.datetimepicker.full.min.js"></script>
        <script type="text/javascript" src="../_include/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="../_include/js/dataTables.bootstrap.min.js"></script>
        <script type="text/javascript" src="//cdn.datatables.net/plug-ins/1.10.13/i18n/Portuguese-Brasil.json"></script>
        <script>
            $(document).ready(function() {
                $('#tabela').DataTable( {
                    "order": [[ 3, "desc" ]],
                    //"ordering": false,
                    "oLanguage": {
                        "sUrl": "../_include/js/Portuguese-Brasil.json"
                    },
                    initComplete: function () {

                        var coluna_filtro = 0;

                        this.api().columns().every( function (mostra) {

                            var column = this;
                            coluna_filtro += 1;
                            if (coluna_filtro==1){
                                var select = $('<select><option value="">TODOS</option></select>')
                                    .appendTo( $(column.footer()).empty() )
                                    .on( 'change', function () {
                                        var val = $.fn.dataTable.util.escapeRegex($(this).val());

                                        column
                                            .search( val ? '^'+val+'$' : '', true, false )
                                            .draw();
                                    } );

                                column.data().unique().sort().each( function ( d, j ) {
                                    select.append( '<option value="'+d+'">'+d+'</option>' )

                                } );
                            }

                            if (coluna_filtro==2){
                                var select = $('<select><option value="">TODOS</option></select>')
                                    .appendTo( $(column.footer()).empty() )
                                    .on( 'change', function () {
                                        var val = $.fn.dataTable.util.escapeRegex($(this).val());

                                        column
                                            .search( val ? '^'+val+'$' : '', true, false )
                                            .draw();
                                    } );

                                column.data().unique().sort().each( function ( d, j ) {
                                    select.append( '<option value="'+d+'">'+d+'</option>' )

                                } );
                            }

                        } );
                    }
                } );
            } );
        </script>

        <script>/*
             window.onerror = function(errorMsg) {
             $('#console').html($('#console').html()+'<br>'+errorMsg)
             }*/

            $.datetimepicker.setLocale('pt-BR');

            $('.DTpicker').datetimepicker({
                format:'d/m/Y H:i',
            });

            $('.Dpicker').datetimepicker({
                format:'d/m/Y',
                timepicker:false,
            });

        </script>
    </body>
</html>