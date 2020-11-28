<div class="container">
    <div class="justify-content-md-center">
        <div class="row"><h2><?php echo $pregunta['pretitulo']; ?></h2></div>
        <div class="row"><p><?php echo $pregunta['predescripcion']; ?></p></div>
    </div>
    <br>

    <ul class="media-list">
                      <li class="media">
                        <a class="pull-left" href="#">
                          <img class="media-object img-circle" src="https://s3.amazonaws.com/uifaces/faces/twitter/dancounsell/128.jpg" alt="profile">
                        </a>
                        <div class="media-body">
                          <div class="well well-lg">
                              <h4 class="media-heading text-uppercase reviews">Marco </h4>
                              <ul class="media-date text-uppercase reviews list-inline">
                                <li class="dd">22</li>
                                <li class="mm">09</li>
                                <li class="aaaa">2014</li>
                              </ul>
                              <p class="media-comment">
                                Great snippet! Thanks for sharing.
                              </p>
                              <a class="btn btn-info btn-circle text-uppercase" href="#" id="reply"><span class="glyphicon glyphicon-share-alt"></span> Reply</a>
                              <a class="btn btn-warning btn-circle text-uppercase" data-toggle="collapse" href="#replyOne"><span class="glyphicon glyphicon-comment"></span> 2 comments</a>
                          </div>              
                        </div>
                      </li>
    </ul>

    <form action="<?= base_url('pregunta/responder') ?>" method="post" class="form-horizontal"> 
    <input type="hidden" name="Pregunta" value="<?= $pregunta['preid']; ?>">
        <div class="form-group">
            <label for="email" class="col-sm-3 control-label">Responde a esta pregunta</label>
            <div class="col-sm-10">
                <textarea class="form-control" name="Respuesta" rows="4"></textarea>
            </div>
        </div>
        
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">                    
                <button class="btn btn-dark  btn-circle" type="submit">Responder</button>
            </div>
        </div>         
    </form>
</div>