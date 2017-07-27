$().ready(function(){
	$.material.init();
	users.build();
	route.build();
});

var users = {
	working: false,
	build: function(){
		$('#carnet').on('keyup', function(e) {
			$(this).val($(this).val().replace(/[^0-9]/g, ''));
		});
	},
	resetInputs: function(){
		var inputs	= [
			'#carnet', '#name', '#lastname', '#nickname'
		];

		for (var i in inputs)
		{
			$(inputs[i]).val('');
		}
	},
	create: function(el) {
		
		if(this.working) return;
		working = true;

		var context = this,
			inputs	= [
				'#carnet', '#name', '#lastname', '#nickname'
			];

		for (var i in inputs)
		{
			if($(inputs[i]).val().length === 0) {
				$(inputs[i]).focus();
				return;	
			}
		}
		
		$('#app-form').hide();
		$('#app-loading').show();

		$.ajax({
			type: 'POST',
			url: APP_URL + '/ajax/user/create',
			data: {
				carnet: $('#carnet').val(),
				first_name:   $('#name').val(),
				last_name:   $('#lastname').val(),
				nick_name:   $('#nickname').val(),
			},

			dataType: 'json',
			success: function(data) {
				context.working = false;
				$('#app-form').show();
				$('#app-loading').hide();
				
				if(data.status){
					$('#app-modal-title').html('Listo');
					$('#app-modal-body').html('Tu cuenta se ha registrado y será verificada brevemente');
					$('#modal-message').modal('toggle');

					context.resetInputs();
					$('#carnet').focus();
				} else {
					$('#app-modal-title').html('Ha ocurrido un error');
					$('#app-modal-body').html(data.report);
					$('#modal-message').modal('toggle');
				}
			},
			error: function(data){
				context.working = false;
				$('#app-form').show();
				$('#app-loading').hide();

				$('#app-modal-title').html('Ha ocurrido un error');
				$('#app-modal-body').html('Por favor intenta de nuevo');
				$('#modal-message').modal('toggle');
			}
		});
	}
};

var route = {
	working: false,
	routeId: false,
	carnet: false,

	build: function(){
		$('.carnet-input').each(function(i,o) {
			$(o).on('keyup', function(e) {
				$(this).val($(this).val().replace(/[^0-9]/g, ''));
			});		
		});
	},

	retry: function() {
		$('#modal-message').modal('toggle');
		this.proccess();
	},

	clean: function(){
		$('#modal-message').modal('toggle');
		$('#carnet_'+this.routeId).val('').focus();
	},

	ticket: function(el){
		if(this.working) return;
			working = true;

		working = true;

		this.carnet = $('#carnet_'+$(el).data('route')).val();
		this.routeId = $(el).data('route');
		this.proccess();
	},


	proccess: function(){
		var userCarnet = this.carnet,
			routeId = this.routeId,
			context = this;

		if(userCarnet.length === 0){
			context.working = false;
			$('#carnet_'+routeId).focus();
			return;
		}

		$('#modal-loading').modal('toggle');

		$.ajax({
			type: 'POST',
			url: APP_URL + '/ajax/route/ticket',
			data: {route_id: routeId, carnet:userCarnet},
			dataType: 'json',
			success: function(data) {
				context.working = false;
				$('#modal-loading').modal('toggle');

				
				if(data.status){
					$('#app-modal-title').html('Listo');
					$('#app-modal-body').html('Te hemos anotado correctamente');
					$('#carnet_'+this.routeId).val('');
					$('#app-clean-box').show();
					$('#modal-message').modal('toggle');
					$('#app-retry-box').hide();

				} else {
					$('#app-modal-title').html('Oops!');
					$('#app-modal-body').html(data.report);
					$('#modal-message').modal('toggle');
					$('#app-clean-box').hide();
				}
			},

			error: function(data) {
				
				context.working = false;
				$('#modal-loading').modal('toggle');

				$('#app-modal-title').html('Ha ocurrido un error');
				$('#app-modal-body').html('El servidor no responde');
				$('#app-clean-box').hide();
				$('#app-retry-box').show();
				$('#modal-message').modal('toggle');
			},
		});
	}
};