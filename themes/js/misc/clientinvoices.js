$(document).ready(function() {
    // hide the screen that dims the page
    $('.screen').hide();
    // hide the transparent screen-wide wrapper that receives that ajax content
    $('#screen_wrapper').hide();
    // hide the ajax loading animation
    $('#loading_image_wrapper').hide();
    // apply dataTable to the invoices table 
    $('table.display').dataTable({
        "sScrollY": "600px",
        "bScrollCollapse": true,
        "bPaginate": false,
        "bJQueryUI": true,
        "bAutoWidth": false,
        "aaSorting": [[ 1, "desc" ]],
        "aoColumnDefs": [
        { "sWidth": "10%",        
          "aTargets": [ -1 ] },
        ]
    });
    // show payment history through ajax
    $('td.history input').click(function() {
        $('.screen').fadeIn('fast');
        $('#loading_image_wrapper').slideDown('fast');
        var invoiceIDValue = $(this).prev().val();
        $.post('/render_payment_history',{invoice_id : invoiceIDValue}, function(data) {
            $('#screen_wrapper').html(data).fadeIn('slow');           
        } )
        $('#loading_image_wrapper').delay(1000).slideUp('fast');
    });
    // show the feature that allows user to manually enter payments
    $('td.enter_payment input').click(function() {
        $('.screen').fadeIn('fast');
        $('#loading_image_wrapper').slideDown('fast');
        var valueOfInvoiceID = $(this).prev().val();
        $.post('/render_enter_payment',{invoice_id : valueOfInvoiceID}, function(data) {                               
            $('#screen_wrapper').html(data).fadeIn('slow');
            attachEventListenersToEnterPaymentDiv();
        } )
        $('#loading_image_wrapper').delay(1000).slideUp('fast');
    });
    // the wrapper that dims the whole window should disappear once clicked
    // including the ajax-content-receiving screen and all its ajax rendered content
    $('#screen_wrapper').click(function(e) {
        $('.screen').hide();
        $(this).hide();
    })
    
});
function attachEventListenersToEnterPaymentDiv() {
    // that feature should not disappear when clicked 
    // unlike the payment history feature
    $('#enter_payment').click(function(e) {
        e.stopPropagation();
    })
    $('p.error').hide();
    $('#specify').hide();
    $('#enter_payment img.close').click(function() {
        $('.screen').hide();
        $('#screen_wrapper').hide();
    });
    $('#enter_payment input:radio[value="other"]').focus(function() {
        $('#specify').slideDown();
    });
    $('#enter_payment input:radio[value="check"]').focus(function() {
        $('#specify').slideUp();
    });
    $('#enter_payment input:radio[value="money_order"]').focus(function() {
        $('#specify').slideUp();
    });
    $('#enter_payment input[type="button"]').click(function() {       
        
        var paymentType = $('#enter_payment input:radio[name="payment_type"]:checked').val();
        var specifiedPaymentType = $('#specify input[name="specify"]').val();
        var valueOfComment = $('#invoice_comment').val();
        var invoiceId = $('#invoice_id').val();
        
        if (!paymentType) {
            $('p.notice').css('color', 'red').html('Please select a payment type.');
            $('p.notice').slideDown().delay(1000).slideUp();
            return;
        } else if (paymentType == 'other' && !specifiedPaymentType) {
            $('p.notice').css('color', 'red').html('Please specify.');
            $('p.notice').slideDown().delay(1000).slideUp();
            return;
        } else {
            $('p.notice').css('color','yellow').html('Closing invoice. Please wait...').slideDown();
            $.post('/render_enter_payment/set_invoice_to_closed',{payment_type: paymentType, 
                specify: specifiedPaymentType, comment: valueOfComment, invoice_id: invoiceId}, function(data) {                               
                if (data == 'closed') {
                   $('p.notice').css('color','green').html('Invoice successfully closed.').delay(2000).slideUp();
                   setTimeout('redirectToPage()',2000); 
                } else {
                    $('p.notice').css('color','red').html('Oops! Something went wrong. Please try again.').delay(3000).slideUp();
                }
            })          
            
            
        }
    });
}
function redirectToPage() {
    var idOfClient = $('#client_id').val();
    window.location.href = '/client/invoices/' + idOfClient;
}