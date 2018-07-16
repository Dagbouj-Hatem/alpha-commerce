<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="{!! asset('/css/main.css') !!}">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Alpha commerce</title>
    <!-- favicon -->
    <link rel="icon" type="image/png" href="{{{ asset('/images/alpha.jpg') }}}" />
  </head>
  <body class="app sidebar-mini rtl">
    <!-- Navbar-->
    <header class="app-header"><a class="app-header__logo" href="/home">Alpha Commerce</a>
      <!-- Sidebar toggle button--><a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
      <!-- Navbar Right Menu-->
      <ul class="app-nav"> 
        <!-- User Menu-->
        <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu"><i class="fa fa-user fa-lg"></i>  {{{ isset(Auth::user()->name) ? Auth::user()->name : '' }}}</a>
          <ul class="dropdown-menu settings-menu dropdown-menu-right">
            <li><a class="dropdown-item" href="/settings"><i class="fa fa-cog fa-lg"></i> Paramètres</a></li>
            <li><a class="dropdown-item" href="/profil"><i class="fa fa-user fa-lg"></i> Profil</a></li>
            <li><a class="dropdown-item" href="{{ url('/logout') }}"  onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fa fa-sign-out fa-lg"></i>Déconnexion</a>
                 <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            </li>
          </ul>
        </li>
      </ul>
    </header>
    <!-- Sidebar menu-->
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">
      <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="https://s3.amazonaws.com/uifaces/faces/twitter/jsa/48.jpg" alt="User Image">
        <div>
          <p class="app-sidebar__user-name">{{{ isset(Auth::user()->type_account) ? Auth::user()->type_account : '' }}}</p> 
        </div>
      </div>
      <ul class="app-menu">
        <li><a class="app-menu__item " href="/home"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Tableau de bord</span></a></li>
        <li class="treeview is-expanded"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-folder"></i><span class="app-menu__label">Produits</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
            <li><a class="treeview-item " href="/produits/add/"><i class="icon fa fa-plus-circle"></i> Ajouter</a></li>
            <li><a class="treeview-item active" href="/produits/"><i class="icon fa fa-list"></i> Liste des produits</a></li> 
          </ul>
        </li>   
        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-users"></i><span class="app-menu__label"> Utilisateurs </span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
            <li><a class="treeview-item" href="/users/add/"><i class="icon fa fa-user-plus"></i> Ajouter</a></li>
            <li><a class="treeview-item" href="/users/"><i class="icon fa fa-list"></i> Liste des utilisateurs</a></li>
          </ul>
        </li>
        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-th-list"></i><span class="app-menu__label">Ventes</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
            <li><a class="treeview-item" href="/ventes/add/"><i class="icon fa fa-plus-circle"></i> Ajouter</a></li>
            <li><a class="treeview-item" href="/ventes/"><i class="icon fa fa-list"></i> Liste des ventes</a></li> 
          </ul>
        </li> 
        <li><a class="app-menu__item" href="/abouts"><i class="app-menu__icon fa fa-info-circle" aria-hidden="true"></i><span class="app-menu__label">À propos</span></a></li>
      </ul>
    </aside>
    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-users"></i> Produits</h1>
          <p>liste des produits.</p>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
          <li class="breadcrumb-item"><i class="fa fa-dashboard fa-lg"></i></li>
          <li class="breadcrumb-item">Tableau de bord</li>
          <li class="breadcrumb-item active"><a href="#">Produits</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body"> 
              
              <table class="table table-hover table-bordered" id="sampleTable">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Référence</th>
                    <th>Désignation</th>
                    <th>Prix</th>
                    <th>Fournisseur</th>
                    <th>Quantité</th>
                    <th>Remise</th>
                    <th>Modifier</th>
                    <th>Supprimer</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($produits as $produit) 
                  <tr>
                    <td>{{ $produit->id }}</td>
                    <td>{{ $produit->ref }}</td>
                    <td>{{ $produit->designation }}</td>
                    <td>{{ $produit->prix }}</td>
                    <td>{{ $produit->fournisseur }}</td>
                    <td>{{ $produit->qte }}</td>
                    <td>{{ $produit->remise }}</td>
                    <td>
                      <a href="{{ route('update_produit',  $produit->id) }}" class="btn btn-info btn-sm">
                        Modifier
                      </a>  
                    </td>
                    <td>
                        <a href="{{ route('delete_produit',  $produit->id) }}" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#exampleModal">
                        Supprimer
                      </a> 
                    </td>
                  </tr> 
                   @endforeach
                </tbody>
              </table>
           
              <!-- modal  delete confirm  -->
              <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Confirmation de la suppression</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <form method="get" action="{{ route('delete_produit',  $produit->id) }}">
                            {{ csrf_field() }}
                          <div class="modal-body">
                          Etes-vous sûr de vouloir supprimer ce produit ?
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                            <button  class="btn btn-danger" type="submit">Supprimer</button>
                          </div>
                    </form>
                  </div>
                </div>
              </div>
              <!-- end modal  delete confirm  -->
            </div>
          </div>
        </div>
      </div>
    </main>
    <!-- Essential javascripts for application to work-->
    <script src="{!! asset('js/jquery-3.2.1.min.js') !!}"></script>
    <script src="{!! asset('js/popper.min.js') !!}"></script>
    <script src="{!! asset('js/bootstrap.min.js') !!}"></script>
    <script src="{!! asset('js/main.js') !!}"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="{!! asset('js/plugins/pace.min.js') !!}"></script>
    <!-- Page specific javascripts-->
    <!-- Data table plugin-->
    <script type="text/javascript" src="{!! asset('js/plugins/jquery.dataTables.min.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('js/plugins/dataTables.bootstrap.min.js') !!}"></script>
    <script type="text/javascript">

      $('#sampleTable').DataTable({
            "language":  
            {
    "sProcessing":     "Traitement en cours...",
    "sSearch":         "Rechercher&nbsp;:",
    "sLengthMenu":     "Afficher _MENU_ &eacute;l&eacute;ments",
    "sInfo":           "Affichage de l'&eacute;l&eacute;ment _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
    "sInfoEmpty":      "Affichage de l'&eacute;l&eacute;ment 0 &agrave; 0 sur 0 &eacute;l&eacute;ment",
    "sInfoFiltered":   "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
    "sInfoPostFix":    "",
    "sLoadingRecords": "Chargement en cours...",
    "sZeroRecords":    "Aucun &eacute;l&eacute;ment &agrave; afficher",
    "sEmptyTable":     "Aucune donn&eacute;e disponible dans le tableau",
    "oPaginate": {
        "sFirst":      "Premier",
        "sPrevious":   "Pr&eacute;c&eacute;dent",
        "sNext":       "Suivant",
        "sLast":       "Dernier"
    },
    "oAria": {
        "sSortAscending":  ": activer pour trier la colonne par ordre croissant",
        "sSortDescending": ": activer pour trier la colonne par ordre d&eacute;croissant"
    },
    "select": {
            "rows": {
                _: "%d lignes séléctionnées",
                0: "Aucune ligne séléctionnée",
                1: "1 ligne séléctionnée"
            } 
    }
}
        });</script> 
  </body>
</html>