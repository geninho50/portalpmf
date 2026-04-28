<?php

  $printDados = '
        <div class="row">
          <div class="col-lg-12">
            <h3 class="page-header"><i class="fa fa-laptop"></i> Dashboard</h3>
            <ol class="breadcrumb">
              <li><i class="fa fa-home"></i><a href="index.html">Home</a></li>
              <li><i class="fa fa-laptop"></i>Dashboard</li>
            </ol>
          </div>
        </div>

        <div class="row">
          <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
            <div class="info-box blue-bg">
              <i class="fa fa-cloud-download"></i>
              <div class="count">1300</div>
              <div class="title">Usuários</div>
            </div>
            <!--/.info-box-->
          </div>
          <!--/.col-->

          <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
            <div class="info-box brown-bg">
              <i class="fa fa-shopping-cart"></i>
              <div class="count">300</div>
              <div class="title">Compras e Aquisições</div>
            </div>
            <!--/.info-box-->
          </div>
          <!--/.col-->

          <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
            <div class="info-box dark-bg">
              <i class="fa fa-thumbs-o-up"></i>
              <div class="count">400</div>
              <div class="title">VPN</div>
            </div>
            <!--/.info-box-->
          </div>
          <!--/.col-->

          <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
            <div class="info-box green-bg">
              <i class="fa fa-cubes"></i>
              <div class="count">1.426</div>
              <div class="title">Conexões</div>
            </div>
            <!--/.info-box-->
          </div>
          <!--/.col-->

        </div>
        <div class="row">

          <div class="col-lg-5 col-md-7">
            <div class="panel panel-default">
              <div class="panel-heading">
                <h2><i class="fa fa-flag-o red"></i><strong>Conexões por Localidade</strong></h2>
                <div class="panel-actions">
                  <a href="index.html#" class="btn-setting"><i class="fa fa-rotate-right"></i></a>
                  <a href="index.html#" class="btn-minimize"><i class="fa fa-chevron-up"></i></a>
                  <a href="index.html#" class="btn-close"><i class="fa fa-times"></i></a>
                </div>
              </div>
              <div class="panel-body">
                <table class="table bootstrap-datatable countries">
                  <thead>
                    <tr>
                      <th></th>
                      <th>Bairro</th>
                      <th>Usuários</th>
                      <th>Trafico</th>
                      <th>Dados</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td></td>
                      <td>Barreiros</td>
                      <td>15</td>
                      <td>25.000 Kbps</td>
					  <td>50 Mbps</td>
                    </tr>
                    <tr>
                      <td></td>
                      <td>Bela Vista</td>
                      <td>05</td>
                      <td>30.000 Kbps</td>
					  <td>58 Mbps</td>
                    </tr>
                    </tr>
                  </tbody>
                </table>
              </div>

            </div>
          </div>';
  echo $printDados;
  
  ?>