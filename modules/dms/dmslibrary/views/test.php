                <div class="col-lg-3">
                    <div class="ibox">
                        <div class="ibox-content">
                            <h3><?= DMS_KBB_HDR3 ?></h3>
                             <hr>
                           <!-- <p class="small"><i class="fa fa-hand-o-up"></i> Drag task between list</p> -->
                            <ul class="sortable-list connectList agile-list" id="completed">
                               <?php foreach($inreview as $row) { ?>
                                   <?php if($row->onhold == 1): ?>
                                       <li class="warning-element" id="<?= $row->id ?>">
                                   <?php elseif($row->blocked == 1): ?>
                                       <li class="danger-element" id="<?= $row->id ?>">
                                   <?php elseif(time() > $row->duedate): ?> 
                                        <li class="warning-element" id="<?= $row->id ?>">    
                                   <?php else: ?>
                                       <li class="success-element" id="<?= $row->id ?>">
                                   <?php endif; ?>
                                   
  <div class="row">
      <div class="col-lg-12">                                   
 <a type ="button" class="btn btn-xs btn-white" data-toggle="modal" data-target="#l<?= $row->id ?>" ><i class="fa fa-user"></i> <?= $row->poc ?></a> 
<span class="float-right "><a href="#" > </a>
                                     <!--   id: <?= $row->id ?> -->
                                        <?php if($row->duedate != " " AND $row->duedate != "01/01/1970" || $row->duedate != " " AND $row->duedate != "12/31/1969"): ?> 
                                            Due <?= $row->duedate ?>
                                        <?php endif; ?> 

</span>
    </div>
    </div> 

  <div class="row">
      <div class="col-lg-12">
           <div class="agile-detail">
<a href="<?= BASE_URL ?>dms-dmslibrary/viewdocrec/<?= $row->id ?>/dmslibadmin/k" class="float-left btn btn-xs btn-white"><i class="fa fa-eye"></i>  <?= $row->title ?> </a> 
 </div>
 </div>
 </div>                               
   <div class="row">
      <div class="col-lg-12">                                  
            <div class="agile-detail">
                                       
    <!-- Tags -->
        <?php if(strlen($row->doctag2) > 0): ?>
        <a href="#" class="float-left btn btn-xs btn-white"><i class="fa fa-tag"></i> <?= $row->doctag2 ?></a>
    <?php endif; ?> 
    <?php if(strlen($row->doctag3) > 0): ?>
        <a href="#" class="float-left btn btn-xs btn-white"><i class="fa fa-tag"></i> <?= $row->doctag3 ?></a>
    <?php endif; ?> 
            </div>
</div>
</div> 

   <div class="row">
      <div class="col-lg-12">                                  
            <div class="agile-detail">
<a class="float-left btn btn-xs btn-primary" style="color: white" href="<?= BASE_URL ?>dms-dmslibrary/inprogress/<?= $row->id ?>/dmslibadmin/k"><i class="fa fa-arrow-left"></i> </a>                                   

<!-- in review  -->
<a href="<?= BASE_URL ?>dms-dmslibrary/managedoccomments/<?= $row->id ?>/dmslibadmin/k" class="float-left btn btn-xs btn-white" title="View Comments"><i class="fa fa-comments"></i></a> 
<a  type ="button" class="float-left btn btn-xs" title="Add Comment" data-toggle="modal" data-target="#j<?= $row->id ?>" >+ <i class="fa fa-comment-o"></i></a> 

<a class="float-right btn btn-xs btn-primary" style="color: white" href="<?= BASE_URL ?>dms-dmslibrary/pending/<?= $row->id ?>/dmslibadmin/k"><i class="fa fa-arrow-right"></i> </a>                                   
<!-- <a class="float-right btn btn-xs btn-success" style="color: white" href="<?= BASE_URL ?>dms-dmslibrary/pending/<?= $row->id ?>/dmslibadmin/k"><i class="fa fa-mail-forward"></i> </a> -->                                   
                                      
                                      
    <?php if($row->onhold == 1): ?>
<!-- <button  hx-trigger="onmouseover" type ="button" class="float-left btn btn-xs btn-warning" data-toggle="tooltip" data-placement="top" title="<?= $row->holdreason ?>" data-target="#r<?= $row->id ?>" ><i class="fa fa-warning"></i> On Hold</button> -->
 <a  type ="button" class="float-left btn btn-xs btn-danger" data-toggle="modal" data-target="#r<?= $row->id ?>" ><i class="fa fa-warning"></i> On Hold</a> 
    <?php else: ?>
         <?php if($row->rejected == 1): ?>
<!-- <button  hx-trigger="onmouseover" type ="button" class="float-left btn btn-xs btn-danger" data-toggle="tooltip" data-placement="top" title="<?= $row->blocker ?>" data-target="#r<?= $row->id ?>" ><i class="fa fa-ban"></i> Blocked</button> -->
<a type ="button" class="float-left btn btn-xs btn-danger" data-toggle="modal" data-target="#j<?= $row->id ?>" ><i class="fa fa-thumbs-down"></i> Rejected</a>
        <?php endif; ?>
                                        <?php if($row->blocked == 1): ?>
<!-- <button  hx-trigger="onmouseover" type ="button" class="float-left btn btn-xs btn-danger" data-toggle="tooltip" data-placement="top" title="<?= $row->blocker ?>" data-target="#r<?= $row->id ?>" ><i class="fa fa-ban"></i> Blocked</button> -->
<a type ="button" class="float-left btn btn-xs btn-danger" data-toggle="modal" data-target="#b<?= $row->id ?>" ><i class="fa fa-ban"></i> Blocked</a>
                                        <?php endif; ?>                                         
    <?php endif; ?>

   <?php if($row->duedate != " " AND $row->duedate != '01/01/1970' || $row->duedate != " " AND $row->duedate != '12/31/1969' ): ?> 
       <?php if(time() > strtotime($row->duedate)): ?>  
            <a  hx-trigger="onmouseover" type ="button" class="float-left btn btn-xs btn-warning" data-toggle="tooltip" data-placement="top" title="Assigned: <?= $row->assigndate ?> Started: <?= $row->startdate ?>" data-target="#l<?= $row->id ?>" ><i class="fa fa-warning"></i> Past Due </a>                                                        
        <?php endif; ?> 
    <?php endif; ?> 
</div>
 </div>
</div>