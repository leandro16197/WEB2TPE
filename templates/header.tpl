<header>  
    <nav class=" navbar navbar-expand-lg navbar-light">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <div class="estado btn btn-secondary dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            {$tituloNav}
            </div>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            {foreach from=$lista_generos item=gen}
                    <a class="dropdown-item" href=genero/{$gen->nombreGen}>{$gen->nombreGen}</a>
                {/foreach} 
            </div>
    </nav>
</header>