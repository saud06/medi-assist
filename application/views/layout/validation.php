<script type="text/javascript">
	function chkEmpty(frm,field,msg){
		var inputVal=$("input[name='"+field+"']").val();//document.forms[frm][field].value;
		 if (inputVal == null || inputVal == "") {
			$("input[name='"+field+"']").parent().addClass("has-error has-feedback");
			$("input[name='"+field+"']").parent().find("span").addClass("fa fa-remove form-control-feedback");
			$("input[name='"+field+"']").parent().find("p").text(msg);
			return 1;
		}else{
			$("input[name='"+field+"']").parent().removeClass("has-error has-feedback");
			$("input[name='"+field+"']").parent().find("span").removeClass("fa fa-remove form-control-feedback");
			$("input[name='"+field+"']").addClass("abc");
			$("input[name='"+field+"']").parent().find("span").addClass("fa fa-check-square text-green form-control-feedback");
			$("input[name='"+field+"']").parent().find("p").text("");
			return 0;
		}
	}
</script> 