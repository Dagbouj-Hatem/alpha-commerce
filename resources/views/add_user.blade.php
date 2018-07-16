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
        <li class="treeview "><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-folder"></i><span class="app-menu__label">Produits</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
            <li><a class="treeview-item " href="/produits/add/"><i class="icon fa fa-plus-circle"></i> Ajouter</a></li>
            <li><a class="treeview-item" href="/produits/"><i class="icon fa fa-list"></i> Liste des produits</a></li> 
          </ul>
        </li>   
        <li class="treeview is-expanded"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-users"></i><span class="app-menu__label"> Utilisateurs </span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
            <li><a class="treeview-item active" href="/users/add/"><i class="icon fa fa-user-plus"></i> Ajouter</a></li>
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
          <h1><i class="fa fa-edit"></i> Ajouter un utilisateur</h1>
          <p>Saisie les informations suivantes</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item">Tableau de bord</li>
          <li class="breadcrumb-item"><a href="#">Utilisateurs</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="offset-3 col-md-6">
          <div class="tile">
            @if(Session::has('success'))
              <div class="alert alert-success alert-dismissible " role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  <span class="sr-only">Close</span>
                </button> 
                 {{ Session::get('success') }}
                  @php

                  Session::forget('success');

                  @endphp
              </div>
            @endif
             @if (count($errors) > 0)
                <div class="alert alert-danger alert-dismissible " role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  <span class="sr-only">Close</span>
                </button> 
                <strong>Erreur de Saisie .</strong> SVP vérifier les informations suivantes : 
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <h3 class="tile-title text-center">Utilisateur</h3>
            <div class="tile-body">
               <form class="form-horizontal" method="POST" action="{{ route('save_user') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-12">Nom complet</label>

                            <div class="col-md-12">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-12">Identifiant</label>

                            <div class="col-md-12">
                                <input id="email" type="text" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-12">Mot de passe </label>

                            <div class="col-md-12">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password-confirm" class="col-md-12">Confirmer votre mot de passe</label>

                            <div class="col-md-12">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('type_account') ? ' has-error' : '' }}">
                            <label for="type_account" class="col-md-12">Type de compte</label>

                            <div class="col-md-12"> 
                                <select id="type_account" class="form-control" name="type_account" required>
                                    <option value="User">User</option>
                                    <option value="Admin">Admin</option>
                                    <option  value="Super Admin">Super Admin</option>
                                </select>
                                @if ($errors->has('type_account'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('type_account') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div> 
                     
                 <button class="btn btn-success btn-block" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Ajouter</button>
              </form>
            </div>
            <div class="tile-footer"> 
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
  
  </body>
</html>