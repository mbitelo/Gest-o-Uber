        <nav class="navbar navbar-inverse -default navbar-static-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="../Inicio"><img src="../_include/img/Logo_Firma.jpeg" style="margin-top: -15px; height: 50px"><span class="sr-only">DEMHAB</span></a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li<?php echo (@$title == "Ínicio") ? " class=\"active\"" : "";?>><a href="../Inicio">Ínicio</a></li>
                        <li<?php echo (@$title == "Consultar") ? " class=\"active\"" : "";?>><a href="../Consultar">Consultar</a></li>
                        <li<?php echo (@$title == "Listar") ? " class=\"active\"" : "";?>><a href="../Listar">Listar</a></li>
                        <li<?php echo (@$title == "Cadastrar") ? " class=\"active\"" : "";?>><a href="../Cadastrar">Cadastrar</a></li>
                        <!-- <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Formulários <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="#">Action</a></li>
                                <li><a href="#">Another action</a></li>
                                <li><a href="#">Something else here</a></li>
                                <li role="separator" class="divider"></li>
                                <li class="dropdown-header">Nav header</li>
                                <li><a href="#">Separated link</a></li>
                                <li><a href="#">One more separated link</a></li>
                            </ul>
                        </li> -->
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="#sobre" data-toggle="modal" data-target="#modalSobre">Sobre<span class="sr-only">(current)</span></a></li>
                    </ul>
                </div><!--/.nav-collapse -->
            </div>
        </nav>