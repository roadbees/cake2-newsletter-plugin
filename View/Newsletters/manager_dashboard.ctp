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

    <?php echo $this->element('newsletters_overview', array('plugin' => 'Newsletter')); ?> 
    <?php echo $this->element('subscribers_overview', array('plugin' => 'Newsletter')); ?> 


    
</div>

<script>
    //get the json models
    var _newsletters = <?php echo json_encode($newsletters) ?>,
        _subscribers = <?php echo json_encode($subscribers) ?>;

    //some preparations
    //for newsletters 
    var newsletters = [];

    _.each(_newsletters, function(newsletter){
        newsletters.push(newsletter.Newsletter);
    });

    //for subscribers 
    var subscribers = [];

    _.each(_subscribers, function(subscriber){
        subscribers.push(subscriber.Subscriber);
    });

    //draw the pie charts


    //by views
    /*
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
    });*/



</script>