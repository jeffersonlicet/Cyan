<!DOCTYPE html>
<html lang="en">
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<meta name="description" content="Sistema de ruta Los Teques - SA">
	<meta name="author" content="Jefferson Licet">
	<link rel="apple-touch-icon" sizes="57x57" href="<?= URL::to('/'); ?>/img/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="<?= URL::to('/'); ?>/img/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="<?= URL::to('/'); ?>/img/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="<?= URL::to('/'); ?>/img/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="<?= URL::to('/'); ?>/img/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="<?= URL::to('/'); ?>/img/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="<?= URL::to('/'); ?>/img/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="<?= URL::to('/'); ?>/img/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="<?= URL::to('/'); ?>/img/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="<?= URL::to('/'); ?>/img/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= URL::to('/'); ?>/img/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="<?= URL::to('/'); ?>/img/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= URL::to('/'); ?>/img/favicon-16x16.png">
    <link rel="manifest" href="<?= URL::to('/'); ?>/img/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="<?= URL::to('/'); ?>/img/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">

	<title>Sistema de rutas: LT-SA</title>

	<!-- Bootstrap core CSS -->
	<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/icon?family=Material+Icons">
	<link href="<?= URL::to('/'); ?>/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?= URL::to('/'); ?>/css/bootstrap-material-design.min.css" rel="stylesheet">
	<link href="<?= URL::to('/'); ?>/css/ripples.min.css" rel="stylesheet">
    <link href="<?= URL::to('/'); ?>/css/app.css" rel="stylesheet">

    <meta property="og:url" content="http://usb.azurewebsites.net" />
    <meta property="og:title" content="Sistema de rutas: LT-SA" />
    <meta property="og:description" content="Sistema de rutas: LT-SA" />

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-56940433-10"></script>
	<script>
	window.dataLayer = window.dataLayer || [];
	function gtag(){dataLayer.push(arguments);}
	gtag('js', new Date());

	gtag('config', 'UA-56940433-10');
	</script>
	</head>

	<body>
	<div id="splash">
		<svg class="spinner" width="65px" height="65px" viewBox="0 0 66 66" xmlns="http://www.w3.org/2000/svg">
			<circle class="path" fill="none" stroke-width="6" stroke-linecap="round" cx="33" cy="33" r="30"></circle>
		</svg>
	</div>

	<div id="app" style="display:none">
		<div class="navbar app-navbar box-shadow--3dp">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle app-toggler" data-toggle="collapse" data-target=".navbar-inverse-collapse">
						<i class="material-icons">menu</i>
					</button>
					<a class="navbar-brand" href="<?= URL::to('/'); ?>">Rutas LT-SA &nbsp;&nbsp;&nbsp;<span class="label label-info"><?= Carbon\Carbon::now()->format('g:i:s A'); ?></span></a>
				</div>

				<div class="navbar-collapse collapse navbar-inverse-collapse">
					<ul class="nav navbar-nav">
						<li class="active"><a href="<?= URL::to('/'); ?>">Rutas</a></li>
						<li><a href="<?= URL::to('/user/create/'); ?>">Registrarme</a></li>
						<li><a href="<?= URL::to('/user/status/'); ?>">Status</a></li>
					</ul>
				</div>
			</div>
		</div>

		<div class="container-fluid" style="margin: 0 auto;">
			<a href="https://play.google.com/store/apps/details?id=com.sparkly.selfy" target="_blank"><img height="100" class="img-responsive" style="max-width: 50%; margin: 0 auto" src="<?= URL::to('/'); ?>/img/selfyimage.png"></a>
		<br />
		    <div class="panel panel-default">
                <div class="panel-body">
                    <div class="list-group-item">
                        <div class="row-content">
                            <h2 class="list-group-item-heading app-item-header"><?= $route->route_name; ?> - <?= $route->departure_at->format('g:i A'); ?></h2>
                            <span class="label <?= $route->is_open ? 'label-primary' : 'label-default' ?>"><?= $route->is_open ? 'Abierta' : 'Abre en '. $route->open_time ?></span>
							<span class="label <?= $route->is_open ? 'label-warning' : 'displayN' ?> <?= $route->gone ? 'displayN' : '' ?>">El bus se va en <?= $route->departure_time ?></span>
                            <span class="label <?= $route->is_open ? 'label-warning' : 'displayN' ?> <?= $route->gone ? '' : 'displayN' ?>">El bus se ha ido</span>
							<span class="label <?= $route->is_open ? 'label-danger' : 'displayN' ?>">Hay <?= count($route->tickets).( count($route->tickets) == 1 ? ' persona' : ' personas') ?> </span>
                        </div>	
                    </div>
                </div>

                <div class="<?= !$route->is_open ? 'displayN' : '' ?> panel-footer app-item-footer">
                    <div class="form-group label-floating">
                        <label class="control-label" for="addon2">Ingresa tu carnet</label>
                        <div class="input-group">
                            <input autocomplete="off" id="carnet_<?= $route->route_id; ?>" class="form-control carnet-input" type="text" />
                            <p class="help-block">Ingresa tu Carnet (i.e. 1200000) o tu Cédula (i.e. V26000000)</p>
							<span class="input-group-btn">
                                <a href="javascript:void(0)" onclick="route.ticket(this);" data-route="<?= $route->route_id; ?>" class="btn btn-raised btn-info">Anotarme</a>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
			<div class="list-group">
                <div class="panel panel-default">
                    <div class="panel-body">
                    <?php $i = 1; ?>
                    <?php foreach($route->tickets as $ticket) : ?>
                        <div class="list-group-item">
                           <div class="row-action-primary">
                                <i class="material-icons">person</i>
                            </div>
                            <div class="row-content">
                                <h4 class="list-group-item-heading"><?= $i ?>. <?= $ticket->user->first_name; ?> <?= $ticket->user->last_name; ?></h4>
                                <span class="label label-primary"><?= $ticket->user->nick_name; ?></span>
                            </div>
                        </div>
                        <div class="list-group-separator"></div>
                    <?php $i++; ?>   
                    <?php endforeach; ?>

                    <?php if(count($route->tickets) == 0): ?>
                        <p>No hay personas anotadas :(</p>
                    <?php endif; ?>
                    </div>
                </div>
			</div>
		</div>

		<div id="app-refresh">
			<a href="javascript:location.reload()" class="btn btn-info  btn-fab"><i class="material-icons">cached</i></a>
		</div>
	</div>

    <div class="modal" id="modal-loading">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h4 class="modal-title">Cargando</h4>
				</div>
				<div class="modal-body">
					<div id="app-loading">
						<svg class="spinner" width="65px" height="65px" viewBox="0 0 66 66" xmlns="http://www.w3.org/2000/svg">
							<circle class="path" fill="none" stroke-width="6" stroke-linecap="round" cx="33" cy="33" r="30"></circle>
						</svg>	
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="modal" id="modal-message">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h4 class="modal-title" id="app-modal-title"></h4>
				</div>
				<div class="modal-body">
					<p id="app-modal-body"></p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Aceptar</button>
					<button type="button" class="btn btn-primary" id="app-clean-box" onclick="route.clean();">Anotar amigo</button>
					<button type="button" class="btn btn-primary" id="app-retry-box" onclick="route.retry();">Intentar de nuevo</button>
				</div>
			</div>
		</div>
    </div>
    
    <footer class="footer">
        <p>Patrocinado por: <a href="http://getselfy.net" target="_blank"><img width="36" height="36" src="<?= URL::to('/'); ?>/img/Selfy.png"> <b>Selfy</b></a></p>
    </footer>
	<!-- Bootstrap core JavaScript
	================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->
	<script type="text/javascript">
		var APP_URL = <?= json_encode(URL::to('/')); ?>
	</script>
	<script src="<?= URL::to('/'); ?>/js/jquery-3.2.1.min.js?v=4"></script>
	<script src="<?= URL::to('/'); ?>/js/bootstrap.min.js?v=4"></script>
	<script src="<?= URL::to('/'); ?>/js/ripples.min.js?v=4"></script>
	<script src="<?= URL::to('/'); ?>/js/material.min.js?v=4"></script>
	<script src="<?= URL::to('/'); ?>/js/app.js?v=4"></script>
	</body>
</html>