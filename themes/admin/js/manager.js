/**
 * Created by coolfire on 08.05.15.
 */
function reload(){
    location.reload();
}
function add_part(orderid){
    $.post('/project/zakazParts/apiCreate', JSON.stringify({
        'orderId': orderid,

        'name': 'Новая Часть'
    }), function (response) {
        if (response.data) {
            reload();
        }
    }, 'json');
}
function delete_part(orderid) {
    $.post('/project/zakazParts/apiDelete', JSON.stringify({
        'id': orderid
    }), function (response) {
        if (response.data) {
            reload();
        }
    }, 'json');
}
function change_title(new_title,part_id){
    $.post('/project/zakazParts/apiEditPart', JSON.stringify({
        'id': part_id,
        'title': new_title
    }), function (response) {
        if (response.data.result) {
            $('#part_title_'.part_id).html(new_title);
        }
    }, 'json');
}
function change_comment(new_comment,part_id){
    $.post('/project/zakazParts/apiEditPart', JSON.stringify({
        'id': part_id,
        'comment': new_comment
    }), function (response) {}, 'json');
}
function send(url) {
    var formData = new FormData($("#up_file")[0]);
    $.ajax({
        url: url,
        type: 'POST',
        data: formData,
        datatype: 'json',
        success: function (data,textStatus,errorThrown) {
            jQuery("#list_files").load(url.replace('add','list'));
            if (data.error) alert(data.error.ProjectChanges_file);
        },
        error: function (data,textStatus,errorThrown) {
            alert('err: '+data+"\nstatus: "+textStatus+errorThrown);
        },
        processData: false,
        contentType: false,
        cache: false
    });

    return false;
}
function approve(obj){
    var data=$(obj).data();
    $.post('/project/zakazParts/apiApprove', JSON.stringify({
        'data': data
    }), function (response) {
        if (response.data) {
            console.log(response);
			$(obj).remove();
        }
    }, 'json');
}
function approveFile(obj){
    var data=$(obj).data();
    $.post('/project/zakaz/apiApproveFile', JSON.stringify({
        'data': data
    }), function (response) {
        if (response.data)obj.remove();
    }, 'json');
}
function spam(orderid){
    $.ajax({
        url: '/project/zakaz/spam?order_id='+orderid,
        type: 'POST',
        datatype: 'json',
        success: function (data,textStatus,errorThrown) {
            if(data.error) alert(data.error);
        },
        error: function (data,textStatus,errorThrown) {
            console.log(data);
        }
    });

    alert('Рассылка запущена');
    return false;
}
$( document ).ready( function() {
    $('#Zakaz_notes, #Zakaz_author_notes').on('keyup',function(event){
        var data = $(this).val();
        var elid = $(this).attr('id');
        var id = $('#order_number').html();
        $.post('/project/zakaz/update?id='+id,
            {'data': data,'id':id,'elid': elid},
        function (response) {
            if (response.data)obj.remove();
        });
    });
});


$( document ).ready( function() {
    $('#Zakaz_notes, #Zakaz_author_notes').on('keyup',function(event){
        var data = $(this).val();
        var elid = $(this).attr('id');
        var id = $('#order_number').html();
        $.post('/project/zakaz/update?id='+id,
            {'data': data,'id':id,'elid': elid},
        function (response) {
            if (response.data)obj.remove();
        });
    });
});

$( document ).ready( function() {
    var arrow = 'fa-angle-down fa-lg';
    $('div.info-block div.panel-heading a').on('click', function() {
        console.log('aaaaa');
        if (arrow == 'fa-angle-down fa-lg') {
            arrow = 'fa-angle-up fa-lg';
            $('div.info-block div.panel-heading a i').removeClass('fa-angle-down fa-lg').addClass(arrow);
        } else {
            arrow = 'fa-angle-down fa-lg';
            $('div.info-block div.panel-heading a i').removeClass('fa-angle-up fa-lg').addClass(arrow);
        }
    });
<<<<<<< HEAD
    
    
    $('p.author-mail-icon').next().hide();
    $('p.author-phone-icon').next().hide();
    $('p.customer-mail-icon').next().hide();
    $('p.customer-phone-icon').next().hide();
    
    $('p.author-mail-icon').on('click', function() {
        if ($('p.author-phone-icon').next().css('display') == 'inline-block') {
            $('p.author-phone-icon').next().hide();
            $(this).next().fadeToggle();
        } else {
            $(this).next().fadeToggle();
        }
    });
    
    $('p.author-phone-icon').on('click', function() {
        if ($('p.author-mail-icon').next().css('display') == 'inline-block') {
            $('p.author-mail-icon').next().hide();
            $(this).next().fadeToggle();
        } else {
            $(this).next().fadeToggle();
        }
    });
    
        $('p.customer-mail-icon').on('click', function() {
        if ($('p.customer-phone-icon').next().css('display') == 'inline-block') {
            $('p.customer-phone-icon').next().hide();
            $(this).next().fadeToggle();
        } else {
            $(this).next().fadeToggle();
        }
    });
    
    $('p.customer-phone-icon').on('click', function() {
        if ($('p.customer-mail-icon').next().css('display') == 'inline-block') {
            $('p.customer-mail-icon').next().hide();
            $(this).next().fadeToggle();
        } else {
            $(this).next().fadeToggle();
        }
    });

	
	//------------------
    var arrow = 'fa-angle-up';
    
    contactSectionButton = $('div.contactme');
    contactSectionButton.on('click', function() {
        if (arrow == 'fa-angle-up') {
            arrow = 'fa-angle-down';
            $('.fa').removeClass('fa-angle-up').addClass(arrow);
        } else {
            arrow = 'fa-angle-up';
            $('.fa').removeClass('fa-angle-down').addClass(arrow);
        }
        $('section.contact-section').slideToggle();
    });
	////----------------
    
});
