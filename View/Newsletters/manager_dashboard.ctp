<?php 
echo $this->Html->css('/newsletter/css/newsletter'); 
echo $this->Html->script('/newsletter/js/newsletter'); 
echo $this->Html->script('/newsletter/js/libs/underscore-min');
echo $this->Html->script('/newsletter/js/libs/raphael-min');  
echo $this->Html->script('/newsletter/js/libs/g.raphael-min'); 
echo $this->Html->script('/newsletter/js/libs/g.pie-min'); 
echo $this->Html->script('/newsletter/js/libs/g.bar-min'); 
?>

<div id="newsletter-plugin-index">
    <div id="newsletterMenu">
        <ul id="menu" class="">
            <li><?php echo $this->Html->link('Newsletters Overview',array('manager' => true, 'controller' => 'newsletters', 'action' => 'index'))?></li>
            <li><?php echo $this->Html->link('Subscribers Overview',array('manager' => true, 'controller' => 'subscribers', 'action' => 'index'))?></li>
        </ul>
    </div>



    <h1>Newsletters Übersicht</h1>

    <div id="newslettersByCampaigns" style="width: 640px; height: 480px;"></div>

    <div id="newslettersByViews" style="width: 640px; height: 480px;"></div>
    
    <h1> Subscribers Übersicht</h1>

    <div id="subscribersByCampaigns" style="width: 640px; height: 480px;"></div>
    
</div>

<script>
    //get the json models
    var _newsletters = <?php echo $newsletters ?>,
        _subscribers = <?php echo $subscribers ?>,
        _campaigns = <?php echo $campaigns ?>;


    //some preparations
    //for newsletters 
    var campaigns = {};

    _.each(_campaigns, function(campaign){
        campaigns[campaign.Campaign._id] = campaign.Campaign;
    });
    //some preparations
    //for newsletters 
    var newslettersByCampaigns = {},
        newsletters = [];

    _.each(_newsletters, function(newsletter){
        newsletters.push(newsletter.Newsletter);
        _.each(newsletter.Newsletter.campaigns, function(id){
            var campaign = campaigns[id].name;
            if(!newslettersByCampaigns[campaign])
                newslettersByCampaigns[campaign] = [];
            newslettersByCampaigns[campaign].push(newsletter.Newsletter);
        });    
    });

    //for subscribers 
    var subscribersByCampaigns = {},
        subscribers = [];

    _.each(_subscribers, function(subscriber){
        subscribers.push(subscriber.Subscriber);
        _.each(subscriber.Subscriber.campaigns, function(id){
            var campaign = campaigns[id].name;
            if(!subscribersByCampaigns[campaign])
                subscribersByCampaigns[campaign] = [];
            subscribersByCampaigns[campaign].push(subscriber.Subscriber);
        });    
    });

    //draw the pie charts

    //draw the newsletters pies
    //by tags    
    var rNewsByTag = Raphael("newslettersByCampaigns"),
        pieNewsByTag = rNewsByTag.piechart(320, 240, 100, _.map(newslettersByCampaigns, function(newsletter){ return newsletter.length;}),
            {legend: _.map(newslettersByCampaigns, function(newsletter, tag){ return tag + "("+newsletter.length+")"; }), legendpos: "west"});

    rNewsByTag.text(320, 100, "Newsletters by Campaigns").attr({ font: "20px sans-serif" });
    pieNewsByTag.hover(function () {
        this.sector.stop();
        this.sector.scale(1.1, 1.1, this.cx, this.cy);

        if (this.label) {
            this.label[0].stop();
            this.label[0].attr({ r: 7.5 });
            this.label[1].attr({ "font-weight": 800 });
        }
    }, function () {
        this.sector.animate({ transform: 's1 1 ' + this.cx + ' ' + this.cy }, 500, "bounce");

        if (this.label) {
            this.label[0].animate({ r: 5 }, 500, "bounce");
            this.label[1].attr({ "font-weight": 400 });
        }
    });

    //by views
    
    var rNewsByViews = Raphael("newslettersByViews"),
        pieNewsByViews = rNewsByViews.piechart(320, 240, 100, _.map(newsletters, function(newsletter){ return newsletter.viewCounter;}),
            {legend: _.map(newsletters, function(newsletter){ return newsletter.title+"("+newsletter.viewCounter+")"; }), legendpos: "west"});

    rNewsByViews.text(320, 100, "Newsletters by views").attr({ font: "20px sans-serif" });
    pieNewsByViews.hover(function () {
        this.sector.stop();
        this.sector.scale(1.1, 1.1, this.cx, this.cy);

        if (this.label) {
            this.label[0].stop();
            this.label[0].attr({ r: 7.5 });
            this.label[1].attr({ "font-weight": 800 });
        }
    }, function () {
        this.sector.animate({ transform: 's1 1 ' + this.cx + ' ' + this.cy }, 500, "bounce");

        if (this.label) {
            this.label[0].animate({ r: 5 }, 500, "bounce");
            this.label[1].attr({ "font-weight": 400 });
        }
    });

    //draw the subscribers pies
    //by tags    
    var rSubsByTag = Raphael("subscribersByCampaigns"),
        pieSubsByTag = rSubsByTag.piechart(320, 240, 100, _.map(subscribersByCampaigns, function(subscriber){ return subscriber.length;}),
            {legend: _.map(subscribersByCampaigns, function(subscriber, sub){ return sub + "("+subscriber.length+")"; }), legendpos: "west"});

    rSubsByTag.text(320, 100, "Subscribers by Campaigns").attr({ font: "20px sans-serif" });
    pieSubsByTag.hover(function () {
        this.sector.stop();
        this.sector.scale(1.1, 1.1, this.cx, this.cy);

        if (this.label) {
            this.label[0].stop();
            this.label[0].attr({ r: 7.5 });
            this.label[1].attr({ "font-weight": 800 });
        }
    }, function () {
        this.sector.animate({ transform: 's1 1 ' + this.cx + ' ' + this.cy }, 500, "bounce");

        if (this.label) {
            this.label[0].animate({ r: 5 }, 500, "bounce");
            this.label[1].attr({ "font-weight": 400 });
        }
    });


</script>