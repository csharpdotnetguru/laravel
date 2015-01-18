var Networks = {

    addNetwork: function () {

        $('#networks > tbody:last').append($('#networks > tbody > tr:last').clone());
        $('#networks > tbody > tr:last td#network_name').html('<input name="network_name" placeholder="Insert Hostname">');
        $('#networks > tbody > tr:last td#actions').html('<button class="btn btn-success save-network">Save</button>');

        $(".save-network").click(function () {
            Networks.saveNetwork(this);
        });
    },
    sumId: function (match) {
        var i = parseInt(match.substring(1, match.length));
        i++;
        return "_" + i;
    },
    saveNetwork: function (e) {
        var _tr = $(e).parents('tr');

        var network = {};
        network.network_name = $(_tr).find("input[name='network_name']").val();

//        Call backend to store network and get network_id
//        $.post( "/", network, function( data ) {
//            console.log( data.network_id );
//        }, "json");

        // @TODO this should be done after receive post
        $(_tr).find("td#network_name").html(network.network_name);
        $(_tr).find("td#actions").html('<a data-item-id="111" class="btn btn-info btn-network edit-network" ><span class="glyphicon glyphicon-pencil"></span></a><a data-item-id="111" class="btn btn-danger btn-network delete-network"><span class="glyphicon glyphicon-remove-circle"></span></a>');

        $(".edit-network").click(function () {
            Networks.editNetwork(this);
        });

        $(".delete-network").click(function () {
            Networks.deleteNetwork(this);
        });
    },

    deleteNetwork: function (e) {

//        Call backend to delete network
//        $.post( "/", network, function( data ) {
//            console.log( data.network_id );
//        }, "json");

        $(e).parents('tr').remove();


    },

    editNetwork: function (e) {
        var _tr = $(e).parents('tr');
        var network = {};
        network.network_name = $(_tr).find("td#network_name").html();

        $(_tr).find("td#network_name").html('<input name="network_name" placeholder="Insert Network Name">');
        $(_tr).find("td#actions").html('<button class="btn btn-success save-network">Save</button>');

        $(".save-network").click(function () {
            Networks.saveNetwork(this);
        });


        $(_tr).find("td#network_name > input[name='network_name']").val(network.network_name);


    }


};

$(function () {
    $("#add-new-network").click(function () {
        Networks.addNetwork();
    });

    $(".edit-network").click(function () {
        Networks.editNetwork(this);
    });

    $(".delete-network").click(function () {
        Networks.deleteNetwork(this);
    });

})