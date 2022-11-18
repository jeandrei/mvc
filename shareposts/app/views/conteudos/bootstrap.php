<?php require APPROOT . '/views/inc/header.php'; ?>
<style>
      .my-custom-row {
        background-color: bisque;
        height: 400px;
      }
      .color-row {
        background-color: bisque;
      }
    </style>
    <div class="container">
      <hr />
      <div class="row color-row">
        <div class="col-sm-12 col-md-6 col-lg-2 border bg-light">
          Em pequenas telas tamanho 12, em telas medianas 6 e em grandes 2
        </div>
        <div class="col-sm-12 col-md-6 col-lg-8 border bg-light">
          Em pequenas telas tamanho 12, em telas medianas 6 e em grandes 8
        </div>
      </div>

      <hr />

      <div class="row color-row">
        <div class="col-6 order-md-2 border bg-light">Mudando a ordem 1</div>
        <div class="col-6 order-md-1 border bg-light">Mudando a ordem 2</div>
      </div>

      <hr />

      <div class="row color-row">
        <div class="col-sm-4 offset-2 border bg-light">
          Offset é um espaço a esquerda para auxiliar no alinhamento
        </div>
        <div class="col-sm-4 offset-1 border bg-light">Offset</div>
      </div>

      <hr />

      <div class="row my-custom-row justify-content-center align-items-center">
        <div class="col-sm-4">
          <div class="p-3 border bg-light">
            Horizontal - justify-content-center pode ser start, end
          </div>
        </div>
        <div class="col-sm-4">
          <div class="p-3 border bg-light">
            Vertical - align-items-center pode ser start, end
          </div>
        </div>
      </div>

      <hr />

      <div class="row my-custom-row justify-content-around align-items-center">
        <div class="col-sm-4">
          <div class="p-3 border bg-light">
            Horizontal - justify-content-around vai distribuir os itens
            igualmente na horizontal
          </div>
        </div>
        <div class="col-sm-4">
          <div class="p-3 border bg-light">
            Vertical - align-items-center pode ser start, end
          </div>
        </div>
      </div>

      <hr />

      <div class="row my-custom-row justify-content-between align-items-center">
        <div class="col-sm-4">
          <div class="p-3 border bg-light">
            Horizontal - justify-content-between primeiro elemento sempre no
            início e o último elemento sempre no final
          </div>
        </div>
        <div class="col-sm-4">
          <div class="p-3 border bg-light">
            Vertical - align-items-center pode ser start, end
          </div>
        </div>
      </div>

      <hr />

      <div
        class="row my-custom-row justify-content-center align-items-center gx-5"
      >
        <div class="col-sm-4">
          <div class="p-3 border bg-light">
            Horizontal - gx-5 - Gutter - padding lateral entre as colunas
          </div>
        </div>
        <div class="col-sm-4">
          <div class="p-3 border bg-light">
            Vertical - gy-5 - Gutter - padding superior e inferior
          </div>
        </div>
      </div>
    </div>
    <!-- container -->
<?php require APPROOT . '/views/inc/footer.php'; ?>