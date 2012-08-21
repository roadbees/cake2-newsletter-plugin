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
    <h1>Dashboard</h1>
    <section id="newsletter-stats">
        <h2>Stats</h2>
        <div id="stats-tables">
            <table>
                <thead>
                    <tr>
                        <th colspan="2">Anzahl</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Newsletters:</td><td><?php echo count($newsletters) ?></td>                        
                    </tr>
                    <tr>
                        <td>veröffentlichte Newsletters:</td><td><?php echo count($publishedNewsletters) ?></td>                        
                    </tr>
                    <tr>
                        <td>Anmeldungen:</td><td><?php echo count($subscribers) ?></td>                        
                    </tr>
                    <tr>
                        <td>Kampagnen:</td><td><?php echo count($campaigns) ?></td>                        
                    </tr>
                </tbody>
            </table>
            <table>
                <thead>
                    <tr>
                        <th colspan="4">Newsletters Details</th>
                    </tr>
                    <tr>
                        <th>Title:</th>                        
                        <th>erstellt am:</th>
                        <th>veröffentlicht?:</th>
                        <th>veröffentlicht am:</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($newsletters as $newsletter): ?>
                    <tr>
                        <td><?php echo $newsletter['Newsletter']['title'] ?></td>
                        <td><?php echo $this->Time->nice($newsletter['Newsletter']['created']->sec); ?></td>                        
                        <td><?php echo (String)$newsletter['Newsletter']['published'] ?></td>
                        <td><?php if(!$newsletter['Newsletter']['published']) echo "N/A"; else echo $this->Time->nice($newsletter['Newsletter']['publishedDate']->sec); ?></td>
                    </tr>                    
                    <?php endforeach; ?>
                </tbody>
            </table>
            <div><?php //debug($subscribers) ?></div>
            <div><?php debug($newsletters) ?></div>
        </div>
    </section>
    <secion id="graphs">
        <h2>Graphs</h2>
        <div id="newslettersByViews" style="width: 640px; height: 480px;"></div>
    </secion>
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



</script>