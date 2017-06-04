$(document).ready(function() {
  $(".confirm").confirm({
		text : "Deseja realmente excluir este Item?",
		title : "  Exclusão de Item",
		confirmButton : " Excluir",
		cancelButton : " Cancelar",
                post:true
         
	});
    
 $('.teste').click(function(){
     alert('teste');
 });
 
  $('.telefone').mask(SPMaskBehavior, spOptions);
  $('.date').mask('00/00/0000');
        
}); //fechamento do ready

var SPMaskBehavior = function (val) {
  return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
},
spOptions = {
  onKeyPress: function(val, e, field, options) {
      field.mask(SPMaskBehavior.apply({}, arguments), options);
    }
};


