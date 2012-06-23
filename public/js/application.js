var Registro = new function() {
	
	return {

		excluir : function() {
			$('#excluir').live('click', function(event){

				var excluir = confirm('Deseja excluir este registro?');

				if (! excluir) {
					event.preventDefault();
				} 
			});
		}
			
	}
}