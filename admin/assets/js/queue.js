/**
 * Queue JavaScript
 *
 * @version  1.1
 * @author Daniel Eliasson <daniel at stilero.com>
 * @copyright  (C) 2013-dec-29 Stilero Webdesign (http://www.stilero.com)
 * @category Components
 * @license	GPLv2
 * 
 */

jQuery(function($){
    /**
     * Shows a dialog alert with a successful message
     * @param string message The message to display
     * @returns void
     */
    var successAlert = function(message){
        var html = '<div class="alert alert-success alert-dismissable">' +
                '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">'+
                '&times;</button>'+
                message
                +'</div>';
        //$(html).appendTo('#social_promoter_alert');
        //$(html).html('#social_promoter_alert');
    };
    
    /**
     * Shows a fail message
     * @param string message HTML message to display
     * @returns void
     */
    var failAlert = function(message){
        var html = '<div class="alert alert-warning alert-dismissable">' +
                '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">'+
                '&times;</button>'+
                message
                +'</div>';
        $(html).appendTo('#social_promoter_alert');
        //$(html).html('#social_promoter_alert');
    };
    
    /**
     * Shows a Error message
     * @param string message HTML message to display
     * @returns void
     */
    var errorAlert = function(message){
        var html = '<div class="alert alert-danger alert-dismissable">' +
                '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">'+
                '&times;</button>'+
                message
                +'</div>';
        $(html).appendTo('#social_promoter_alert');
        //$(html).html('#social_promoter_alert');
    };
    
    /**
     * Hides the row
     * @returns void
     */
    var hideRow = function(row){
        var id = '#'+row;
        $(id).fadeOut();
    }
    
    /**
     * Submits the row to the Queue
     */
    $('form[id^="queueform"]').submit(function(e){
        e.preventDefault();
        var params = $(this).serialize();
        var row = this.row;
    
        $.getJSON('index.php', params, function(data){
            if(data.meta.code == '200'){
                successAlert('<strong>Added!</strong> Image added to queue');
                hideRow(row.value);
            }else{
                failAlert('<strong>Warning!</strong><br />' + data.meta.error_message, '#likedialog');
            }
        }).error(function(){
            errorAlert('<strong>Error!</strong> server error occured.', '#likedialog');
        });
    });
    
    /**
     * Submits the row to the Queue
     */
    $('form[id^="hideme"]').submit(function(e){
        e.preventDefault();
        var params = $(this).serialize();
        var row = this.row;
        hideRow(row.value);
        $.getJSON('index.php', params, function(data){
            if(data.meta.code == '200'){
                successAlert('<strong>Hidden!</strong> Image hidden from queue');
                hideRow(row.value);
            }else{
                failAlert('<strong>Warning!</strong><br />' + data.meta.error_message, '#likedialog');
            }
        }).error(function(){
            errorAlert('<strong>Error!</strong> server error occured.', '#likedialog');
        });
    });
    
});