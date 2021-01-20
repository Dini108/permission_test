$.fn.extend({
    treed: function (o) {

        var openedClass = 'fa-plus';
        var closedClass = 'fa-minus';

        if (typeof o != 'undefined'){
            if (typeof o.openedClass != 'undefined'){
                openedClass = o.openedClass;
            }
            if (typeof o.closedClass != 'undefined'){
                closedClass = o.closedClass;
            }
        };

        //initialize each of the top levels
        let tree = $(this);
        tree.addClass("tree");
        tree.find('li').has("ul").each(function () {
            let branch = $(this); //li with children ul
            branch.prepend("<i class='indicator fas " + closedClass + "'></i>");
            branch.addClass('branch');
            let icon = $(this).children('i:first');
            icon.on('click', function (e) {
                $(this).toggleClass(openedClass + " " + closedClass);
                if (this == e.target) {
                    $(this).parent().children().children().toggle();
                }
            })
        });

        $('ul').children('li').find('span').on('click',  function(event) {
            console.log($(this).parent().data('id'));
            if (this == event.target) {
                removeActiveClass();
                let id = $(this).parent().data('id');
                $(this).toggleClass('active');
                $('#category_id').val(id);
                getFiles();
                getPermission();
                getOperations();
            }
        })

        $('#upload_permission').click(function(e) {
            let categoryId = $('#category_id').val();
            $.ajax({
                type: 'GET',
                url: 'set-upload-permission/' + categoryId,
                success: function(data) {
                    $('#upload_permission').prop("checked",JSON.parse(data));
                    getOperations();
                }
            });
            e.preventDefault();
        });
        $('#download_permission').click(function(e) {
            let categoryId = $('#category_id').val();
            $.ajax({
                type: 'GET',
                url: 'set-download-permission/' + categoryId,
                success: function (data) {
                    $('#download_permission').prop("checked",JSON.parse(data));
                    getFiles();
                }
            });
            e.preventDefault();
        });

        $(document).on('click', '#new-category', function(){
            $('.modal-body #parent_id').val($(this).data('catid'));
            $('.modal-body #category_id').val($(this).data('catid'));
        });

        $(document).on('click', '#edit-category', function(){
            $('.modal-body #parent_id').val($(this).data('parentid'));
            $('.modal-body #category_id').val($(this).data('catid'));
            $('.modal-body #title').val($(this).data('mytitle'));
        });

        $(document).on('click', '#delete-category', function(){
            $('.modal-body #category_id').val($(this).data('catid'));
        });

        $(document).on('click', '#upload-file', function(){
            $('.modal-body #category_id').val($(this).data('catid'));
        });
    }
});
function getOperations(){
    let id = $('#category_id').val();
    $.ajax({
        type: 'GET',
        url: 'get-operations/' + id,
        success: function success(data) {
            $('#operations_container').html(data);
        }
    });
}
function getFiles(){
    let id = $('#category_id').val();
    $.ajax({
        type: 'GET',
        url: 'get-file/' + id,
        success: function success(data) {
            $('#files_container').html(data);
        }
    });
}
function getPermission(){
    let id = $('#category_id').val();
    $.ajax({
        type: 'GET',
        url: 'get-permission/' + id,
        success: function success(data) {
            refreshPermissions(data);
        }
    });
}
function removeActiveClass(){
    $('ul').children('li').find('span').each( function (){
        $(this).removeClass('active');
    });
}
function refreshPermissions(data){
    let parsedData = JSON.parse(data);
    if (parsedData.length !== 0) {
        parsedData.forEach((permission, index, array) => {
            if (permission.permission_id === 1) {
                $('#upload_permission').prop("checked", true);
            } else {
                $('#download_permission').prop("checked", false);
            }
            if (permission.permission_id === 2) {
                $('#download_permission').prop("checked", true);
            } else {
                $('#download_permission').prop("checked", false);
            }
        });
    } else {
        $('#upload_permission').prop("checked",false);
        $('#download_permission').prop("checked",false);
    }
}

$('#tree1').treed();


