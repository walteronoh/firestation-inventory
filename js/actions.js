$(document).ready(function(){
    /*user Login Form*/
    $('#loginForm').on('submit',function(e){
        e.preventDefault();
        $('.login_msg').empty();
        var form_data=$(this).serialize();
        $.ajax({
            url:'pages/actions/actions.php',
			type:'post',
			dataType:'json',
            data:form_data + '&login=login',
            success:function(data){
                if(data.error){
                    $('.login_msg').append(data.error);
                }else if(data.success){
                    window.location.href='pages/dashboard.php';
                    $('#loginForm')[0].reset();
                }else{
                }
            }
        });
    });

    /*Add Client Form*/
    $('#addClientForm').on('submit',function(e){
        e.preventDefault();
        $('.client_msg').empty();
        var form_data=$(this).serialize();
        $.ajax({
            url:'actions/actions.php',
			type:'post',
			dataType:'json',
            data:form_data + '&add_client=add_client',
            success:function(data){
                if(data.error){
                    $('.client_msg').append(data.error);
                }else{
                    $('.client_msg').append(data.success);
                    $('#addClientForm')[0].reset();
                    $('.added_client').append(data.output);
                }
                setTimeout(function(){
                    $('.client_msg').empty();
                },2000);
            }
        });
    });

    /*Add Item Form*/
    $('#addItemForm').on('submit',function(e){
        e.preventDefault();
        $('.item_msg').empty();
        var form_data=$(this).serialize();
        $.ajax({
            url:'actions/actions.php',
			type:'post',
			dataType:'json',
            data:form_data + '&add_item=add_item',
            success:function(data){
                if(data.error){
                    $('.item_msg').append(data.error);
                }else{
                    $('.item_msg').append(data.success);
                    $('#addItemForm')[0].reset();
                    $('.added_item').append(data.output);
                }
                setTimeout(function(){
                    $('.item_msg').empty();
                },2000);
            }
        });
    });

    /*Add Service Form*/
    $('#addServiceForm').on('submit',function(e){
        e.preventDefault();
        $('.service_msg').empty();
        var form_data=$(this).serialize();
        $.ajax({
            url:'actions/actions.php',
			type:'post',
			dataType:'json',
            data:form_data + '&add_service=add_service',
            success:function(data){
                if(data.error){
                    $('.service_msg').append(data.error);
                }else{
                    $('.service_msg').append(data.success);
                    $('#addServiceForm')[0].reset();
                    $('.added_service').append(data.output);
                }
                setTimeout(function(){
                    $('.service_msg').empty();
                },2000);
            }
        });
    });
    
   function checksubcounty(){
    $('.subcounty').change(function(){
        $('.outputWards').empty();
        var subcounty=$(this).val();
        $.ajax({
            url:'actions/actions.php',
			type:'post',
			dataType:'json',
            data:{subcounty:subcounty,check_ward:"check_ward"},
            success:function(data){
                $('.outputWards').append('<option value="">--Ward--</option>'+data.success);
            }
        });
    });
   }
    checksubcounty();

    /*show business name*/
    $('#wards').change(function(){
        $('.outputBusiness').empty();
        var ward=$(this).val();
        $.ajax({
            url:'actions/actions.php',
			type:'post',
			dataType:'json',
            data:{ward:ward,show_business:"show_business"},
            success:function(data){
                $('.outputBusiness').append(data.success);
            }
        });
    });

    /*update */
    $(document).on('click','.update_client',function(){
        var id=$(this).attr('data-item');
        $.ajax({
            url:'actions/actions.php',
			type:'post',
			dataType:'json',
            data:{id:id,update_client:"update_client"},
            success:function(data){
                $('.client_content').html(data.success);
                updateClientForm();
                checksubcounty();
            }
        });
    });

    $(document).on('click','.update_item',function(){
        var id=$(this).attr('data-item');
        $.ajax({
            url:'actions/actions.php',
			type:'post',
			dataType:'json',
            data:{id:id,update_item:"update_item"},
            success:function(data){
                $('.item_content').append(data.success);
                updateItemForm();
            }
        });
    });

    function updateClientForm(){
        $('#updateClientForm').on('submit',function(e){
            e.preventDefault();
            var form_data=$(this).serialize();
            $.ajax({
                url:'actions/actions.php',
                type:'post',
                dataType:'json',
                data:form_data+'&update_client_form=update_client_form',
                success:function(data){
                    if(data.error){
                        $('.client_msg').append(data.error);
                    }else{
                        $('.client_msg').append(data.success);
                        $('#updateClientForm')[0].reset();
                    }
                    setTimeout(function(){
                        $('.client_msg').empty();
                    },2000);
                }
            });
        });
    }

    function updateItemForm(){
        $('#updateItemForm').on('submit',function(e){
            e.preventDefault();
            var form_data=$(this).serialize();
            $.ajax({
                url:'actions/actions.php',
                type:'post',
                dataType:'json',
                data:form_data+'&update_item_form=update_item_form',
                success:function(data){
                    if(data.error){
                        $('.item_msg').append(data.error);
                    }else{
                        $('.item_msg').append(data.success);
                        $('#updateItemForm')[0].reset();
                    }
                    setTimeout(function(){
                        $('.item_msg').empty();
                    },2000);
                }
            });
        });
    }
    
    /*delete */
    $(document).on('click','.remove_client',function(){
        var id=$(this).attr('data-item');
        $get=$(this).parent().parent();
        $.ajax({
            url:'actions/actions.php',
			type:'post',
			dataType:'json',
            data:{id:id,remove_client:"remove_client"},
            success:function(data){
                $get.css('background','tomato');
			    $get.fadeOut(1000);
            }
        });
    });

    $(document).on('click','.remove_item',function(){
        var id=$(this).attr('data-item');
        $get=$(this).parent().parent();
        $.ajax({
            url:'actions/actions.php',
			type:'post',
			dataType:'json',
            data:{id:id,remove_item:"remove_item"},
            success:function(data){
                $get.css('background','tomato');
			    $get.fadeOut(1000);
            }
        });
    });

    $(document).on('click','.remove_service',function(){
        var id=$(this).attr('data-item');
        $get=$(this).parent().parent();
        $.ajax({
            url:'actions/actions.php',
			type:'post',
			dataType:'json',
            data:{id:id,remove_service:"remove_service"},
            success:function(data){
                $get.css('background','tomato');
			    $get.fadeOut(1000);
            }
        });
    });

    /*tabs*/
    $('div #clients').siblings().hide();

    $('.show_clients_tab').click(function(){
        $('div #clients').show();
        $('div #clients').siblings().hide();
    });

    $('.show_items_tab').click(function(){
        $('div #items').show();
        $('div #items').siblings().hide();
    });

    $('.show_services_tab').click(function(){
        $('div #services').show();
        $('div #services').siblings().hide();
    });

});