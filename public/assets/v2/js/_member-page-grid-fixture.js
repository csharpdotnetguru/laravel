var defaultGridPos = [
    {
        htmlContent: '<div class="tile-icon"><div class="tile-title"><h1 class="tile-title">Account Status</h1></div><div class="tile-content"><p class="tile-content">No Status</p><p></p></div></div> ',
        id: 'tile_account_status',
        // class: 'default',
        dataStep: 1,
        dataIntro: 'All the tiles here are draggable and savable. You can re-arrange to your favourite layout for ease of access.',
        col: 1,
        row: 1,
        size_x: 3,
        size_y: 1
    },

    {
        htmlContent: '<div class="tile-icon"><div class="tile-title"><h1 class="tile-title">Dynamo</h1></div><div class="tile-content"><p class="tile-content"></p><p></p></div></div> ',
        id: 'tile_dynamo',
        link: dynamoLink,
        dataStep: 6,
        dataIntro: 'If you want to change a channel\'s country, you can use Dynamo feature. For example, using Dynamo, you can toggle between various different Netflix regions',
        col: 3,
        row: 2,
        size_x: 2,
        size_y: 1
    },
    {
        htmlContent: '<div class="tile-icon"><div class="tile-title"><h1 class="tile-title">Update IP</h1></div><div class="tile-content"><p class="tile-content"></p><p></p></div></div> ',
        id: 'tile_update_ip',
        link: updateIpLink,
        dataStep: 2,
        dataIntro: 'If you have dynamic IP, you might to have Update your IP address from time to time. You can update your IP Address by clicking on this button. You can update IP address automatically as well.',
        col: 6,
        row: 2,
        size_x: 1,
        size_y: 1
    },
    {
        htmlContent: '<div class="tile-icon"><div class="tile-title"><h1 class="tile-title">DynDNS Update</h1></div><div class="tile-content"><p class="tile-content"></p><p></p></div></div> ',
        id: 'tile_dyndns',
        link: dynDnsLink,
        dataStep: 3,
        dataIntro: 'You can use DynDNS to setup automatic IP update. DynDNS is supported by most home routers. You don\' need a DynDNS account to use this feature',
        col: 5,
        row: 2,
        size_x: 1,
        size_y: 1
    },
    {
        htmlContent: '<div class="tile-icon"><div class="tile-title"><h1 class="tile-title">Channels</h1></div><div class="tile-content"><p class="tile-content"></p><p></p></div></div> ',
        id: 'tile_channels',
        link: channelsLink,
        dataStep: 4,
        dataIntro: 'You can see the entire list of supported channel by UnoTelly.',
        col: 1,
        row: 2,
        size_x: 2,
        size_y: 1
    },
    {
        htmlContent: '<div class="tile-icon"><div class="tile-title"><h1 class="tile-title">Devices</h1></div><div class="tile-content"><p class="tile-content"></p><p></p></div></div> ',
        id: 'tile_devices',
        link: devicesLink,
        dataStep: 5,
        dataIntro: 'If you want to setup additional device, you can click on Devices to see setup instructions.',
        col: 6,
        row: 1,
        size_x: 2,
        size_y: 1
    },
    // {
    // 	htmlContent: '<div class="tile-icon"><div class="tile-title"><h1 class="tile-title">Setup Wizard</h1></div><div class="tile-content"><p class="tile-content"></p><p></p></div></div> ',
    // 	id: 'tile_setup_wizard',
    // 	link: setupWizardLink,
    //     col: 5,
    //     row: 2,
    //     size_x: 2,
    //     size_y: 1
    // },
    {
        htmlContent: '<div class="tile-icon"><div class="tile-title"><h1 class="tile-title">Help</h1></div><div class="tile-content"><p class="tile-content"></p><p></p></div></div> ',
        id: 'tile_help',
        link: helpLink,
        col: 8,
        row: 2,
        size_x: 1,
        size_y: 1
    },
    {
        htmlContent: '<div class="tile-icon"><div class="tile-title"><h1 class="tile-title">Knowledge Base</h1></div><div class="tile-content"><p class="tile-content"></p><p></p></div></div> ',
        id: 'tile_knowledage_base',
        link: knowledgeBaseLink,
        col: 8,
        row: 1,
        size_x: 1,
        size_y: 1
    },
    {
        htmlContent: '<div class="tile-icon"><div class="tile-title"><h1 class="tile-title">Networks</h1></div><div class="tile-content"><p class="tile-content"></p><p></p></div></div> ',
        id: 'tile_networks',
        link: networksLink,
        col: 7,
        row: 2,
        size_x: 1,
        size_y: 1
    },
    {
        htmlContent: '<div class="tile-icon"><div class="tile-title"><h1 class="tile-title">My Account</h1></div><div class="tile-content"><p class="tile-content"></p><p></p></div></div> ',
        id: 'tile_my_account',
        link: myAccountLink,
        col: 3,
        row: 3,
        size_x: 2,
        size_y: 1
    },
    {
        htmlContent: '<div class="tile-icon"><div class="tile-title"><h1 class="tile-title">Channel Request</h1></div><div class="tile-content"><p class="tile-content"></p><p></p></div></div> ',
        id: 'tile_channel_request',
        link: channelRequestLink,
        dataStep: 7,
        dataIntro: 'Do you have a channel or feature that you want to request? Use this icon to make your request. We will try our best to fulfill your desire!',
        col: 1,
        row: 3,
        size_x: 2,
        size_y: 1
    },
    {
        htmlContent: '<div class="tile-icon"><div class="tile-title"><h1 class="tile-title">Global Servers</h1></div><div class="tile-content"><p class="tile-content"></p><p></p></div></div> ',
        id: 'tile_global_servers',
        link: globalServersLink,
        dataStep: 8,
        dataIntro: 'Looking for the our servers? Simply click on this tile to have a list of our nearest servers!',
        col: 4,
        row: 1,
        size_x: 2,
        size_y: 1
    },
    {
        htmlContent: '<div class="tile-icon"><div class="tile-title"><h1 class="tile-title">Android App</h1></div><div class="tile-content"><p class="tile-content"></p><p></p></div></div> ',
        id: 'tile_android_app',
        link: AndroidAppLink,
        dataStep: 9,
        dataIntro: 'Download our Android App to quickly update your IP and change your Dynamo region.',
        col: 5,
        row: 3,
        size_x: 2,
        size_y: 1
    }
];