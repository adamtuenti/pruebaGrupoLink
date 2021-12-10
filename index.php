<html>

<head>
  <title>Pokedex</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"> -->
  <link
      rel="stylesheet"
      href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"
    />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <!-- <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
      crossorigin="anonymous"
    /> -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>

<script>
    $(document).on("click", ".open-myModal", function () { 
        var myBookId = $(this).data('id'); 
        $(".modal-body #idPokemon").val( myBookId );
    });


</script>

<?php


$url;
$data = json_decode( file_get_contents('https://pokeapi.co/api/v2/pokedex/'), true );
$arreglo = $data['results'];
for($x = 0; $x < count($arreglo); $x++) {
    if($arreglo[$x]['name'] == 'kanto' ){
        $url = $arreglo[$x]['url'];
    };
    
}
?>


<div class="container-md border border-dark mt-5 p-2">
      <div class="row text-danger">
        <h3 class="text-center">Pokédex</h3>

        <div class="col-8 form-group has-search">
          <span class="fa fa-search form-control-feedback"></span>
          <input type="text" class="form-control" placeholder="Search" />
        </div>
        <div class="col-4">
          <button type="button" class="btn btn-success float-left">
            Filtro
          </button>
        </div>
      </div>
      

      <?php


        $kanto = json_decode( file_get_contents($url), true );
        $pokemones = $kanto['pokemon_entries'];

        for($x = 0; $x < count($pokemones); $x++) {
            $idFoto =  $pokemones[$x]["entry_number"];
            if(strlen($idFoto) == 1){
                $idFoto = '00' . $idFoto . '.png';
            }
            else if(strlen($id) == 2){
                $idFoto = '0' . $idFoto . '.png';
            }
            else{
                $idFoto = $idFoto . '.png';
            }
            $url = $pokemones[$x]['pokemon_species']['url'];
            echo '
            <div class="d-flex flex-row bd- mt-3 open-myModal" data-toggle="modal" id=1 data-target="#myModal">
                <div class="card" style="width: 18rem">
                    <img src="pokemon/'.$idFoto.'" class="card-img-top"/>
                    <div class="card-body">
                        <p class="card-text text-center">'.$pokemones[$x]['pokemon_species']['name'].'</p>
                    </div>
                </div>
            </div>
            ';
            
        }
        ?>

        
      

    </div>


    <!-- Modal del pokemon -->
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">
        <?php
            $descripcion;
            $data = json_decode( file_get_contents($url), true );
            $texto = $data['flavor_text_entries'];
            for($x = 0; $x < count($texto); $x++) {
                if($texto[$x]['language']['name'] == 'es' ){
                    $descripcion = $texto[$x]['flavor_text'];
                };
                
            }

        ?>
        
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">
                &times;
              </button>
              <h4 class="modal-title text-center"> <?php echo $pokemones[$x]['pokemon_species']['name']; ?></h4>
            </div>
            <div class="modal-body">
              <div class="container-fluid">
                <div class="raw">
                  <div class="col-md-6">
                      <?php echo '<img src="pokemon/'.$idFoto.'" class="card-img-top"/>'; ?>
                  </div>
                  <div class="col-md-6 ms-auto">
                    <div class="col-12">
                      <p> <?php echo $descripcion; ?> </p>
                    </div>
                    <div class="col-12">
                      <button type="button" class="btn btn-success">
                        Habilidad 1
                      </button>
                      <button type="button" class="btn btn-info">
                        Habilidad 2
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
  </div>

  


  
</body>


</html>