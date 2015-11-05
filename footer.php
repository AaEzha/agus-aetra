  <footer class="page-footer orange">
    <div class="container">
      <div class="row">
        <div class="col l6 s12">
        <?php
        $qd = $db->query("select judul,isi from informasi");
        $dd = $qd->fetch_array();
        ?>
          <h5 class="white-text"><?=$dd['judul'];?></h5>
          <div class="grey-text text-lighten-4"><?=$dd['isi'];?></div>


        </div>
        <div class="col l3 s12">
          <h5 class="white-text">Links</h5>
          <ul>
          <?php
          $ql = $db->query("select * from tautan where bagian='links' and level='all'");
          while($dl = $ql->fetch_array()){ ?>
            <li><a class="white-text" href="<?=$dl['tautan'];?>"><?=$dl['kata'];?></a></li>
          <?php } ?>
          </ul>
        </div>
        <div class="col l3 s12">
          <h5 class="white-text">Connect</h5>
          <ul>
          <?php
          $ql = $db->query("select * from tautan where bagian='connect' and level='all'");
          while($dl = $ql->fetch_array()){ ?>
            <li><a class="white-text" href="<?=$dl['tautan'];?>"><?=$dl['kata'];?></a></li>
          <?php } ?>
          </ul>
        </div>
      </div>
    </div>
    <div class="footer-copyright">
      <div class="container">
      Made by <a class="orange-text text-lighten-4" href="http://materializecss.com">Materialize</a>
      and <a class="orange-text text-lighten-4" href="#">Agus Prasetyo</a>
      </div>
    </div>
  </footer>