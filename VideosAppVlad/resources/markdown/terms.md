# Guia del Projecte

## Resum del Projecte
Aquest projecte és una aplicació de gestió de vídeos que permet als usuaris pujar, veure i gestionar vídeos. L'aplicació està construïda utilitzant PHP i el framework Laravel, amb un frontend impulsat per JavaScript.

## Resum del Sprint 1
Durant el primer sprint, es van completar les següents tasques:
- Configuració de l'estructura inicial del projecte i l'entorn.
- Creació de l'esquema de la base de dades per a usuaris i vídeos.
- Implementació de l'autenticació i autorització d'usuaris.
- Desenvolupament de la funcionalitat de pujada de vídeos.
- Creació de les vistes bàsiques per mostrar vídeos.

## Resum del Sprint 2
En el segon sprint, el focus va ser millorar les funcionalitats de gestió de vídeos:
- Afegides funcionalitats d'edició i eliminació de vídeos.
- Implementació de la cerca i filtratge de vídeos.
- Millora de la interfície d'usuari i l'experiència d'usuari.
- Afegits tests d'unitat i de funcionalitat per a les funcionalitats relacionades amb vídeos.
- Desplegament de l'aplicació en un entorn de proves.

## Resum del Sprint 3
Durant el tercer sprint, es van realitzar les següents tasques:
- Solució d'errors relacionats amb la gestió de permisos i rols d'usuaris.
- Implementació de la lògica d'autorització per a la ruta /videosmanage.
- Actualització dels tests de funcionalitat per verificar correctament els permisos d'accés.
- Millora de la configuració de les rutes per assegurar-se que només els usuaris amb permisos adequats poden accedir a la gestió de vídeos.
- Revisió i actualització de la documentació del projecte per reflectir els canvis realitzats en la gestió de permisos i autorització.

## Resum del Sprint 4
Durant el quart sprint, es van completar les següents tasques:
- Creació de permisos per a les operacions CRUD de vídeos.
- Assignació de permisos al rol `Video Manager`.
- Creació de mètodes per assignar aquests permisos als usuaris.
- Creació d'usuaris per defecte incloent usuaris regulars, gestors de vídeos i super administradors.
- Assegurar que els usuaris estan assignats als equips correctes.
- Afegits tests per verificar que els usuaris amb i sense permisos poden veure, crear, editar, actualitzar i eliminar vídeos.
- Creació de rutes per gestionar vídeos amb el middleware corresponent.
- Assegurar que les rutes CRUD de vídeos són accessibles només quan l'usuari està logejat.
- Fer que la ruta d'índex de vídeos sigui accessible tant per usuaris logejats com no logejats.
- Afegir una barra de navegació i un peu de pàgina a la plantilla `resources/views/layouts/videos-app-layout.blade.php`.
- Habilitar la navegació entre pàgines a la barra de navegació.

# Resum de l'Sprint 5

## Tasques Completades

1. **Permisos de Gestió d'Usuaris**
    - Creat permisos per gestionar usuaris (operacions CRUD).
    - Assignats aquests permisos als usuaris superadministradors.

2. **Tests d'Usuaris**
    - Afegits tests per a permisos d'usuaris i control d'accés:
        - `user_without_permissions_can_see_default_users_page`
        - `user_with_permissions_can_see_default_users_page`
        - `not_logged_users_cannot_see_default_users_page`
        - `user_without_permissions_can_see_user_show_page`
        - `user_with_permissions_can_see_user_show_page`
        - `not_logged_users_cannot_see_user_show_page`

3. **Tests del UsersManageController**
    - Afegits tests per a les funcionalitats de gestió d'usuaris:
        - `loginAsVideoManager`
        - `loginAsSuperAdmin`
        - `loginAsRegularUser`
        - `user_with_permissions_can_see_add_users`
        - `user_without_users_manage_create_cannot_see_add_users`
        - `user_with_permissions_can_store_users`
        - `user_without_permissions_cannot_store_users`
        - `user_with_permissions_can_destroy_users`
        - `user_without_permissions_cannot_destroy_users`
        - `user_with_permissions_can_see_edit_users`
        - `user_without_permissions_cannot_see_edit_users`
        - `user_with_permissions_can_update_users`
        - `user_without_permissions_cannot_update_users`
        - `user_with_permissions_can_manage_users`
        - `regular_users_cannot_manage_users`
        - `guest_users_cannot_manage_users`
        - `superadmins_can_manage_users`

4. **Rutes**
    - Creat rutes per a la gestió d'usuaris (CRUD) amb el middleware corresponent.
    - Assegurat que les rutes per a l'índex i la pàgina de detall només són accessibles quan estàs logejat.



## Resum del Sprint 6
Durant el sisè sprint, es van completar les següents tasques:
- Creació de permisos per a la gestió de sèries (operacions CRUD).
- Assignació de permisos al rol `Video Manager` i `Super Admin`.
- Implementació de les rutes per a la gestió de sèries amb el middleware corresponent.
- Creació de tests per verificar els permisos i l'accés a les funcionalitats de gestió de sèries:
    - `user_with_permissions_can_see_add_series`
    - `user_without_series_manage_create_cannot_see_add_series`
    - `user_with_permissions_can_store_series`
    - `user_without_permissions_cannot_store_series`
    - `user_with_permissions_can_destroy_series`
    - `user_without_permissions_cannot_destroy_series`
    - `user_with_permissions_can_see_edit_series`
    - `user_without_permissions_cannot_see_edit_series`
    - `user_with_permissions_can_update_series`
    - `user_without_permissions_cannot_update_series`
    - `user_with_permissions_can_manage_series`
    - `regular_users_cannot_manage_series`
    - `guest_users_cannot_manage_series`
    - `videomanagers_can_manage_series`
    - `superadmins_can_manage_series`
- Afegits tests d'unitat per verificar la relació entre sèries i vídeos.
- Millora de la documentació del projecte per incloure els canvis realitzats en la gestió de sèries.

## Resum del Sprint 7

Durant el setè sprint, s'han completat les següents tasques:

1. **Notificacions Push**
    - Configuració de Laravel Echo per escoltar notificacions push en temps real.
    - Creació de la vista `resources/views/notifications/index.blade.php` per mostrar les notificacions.
    - Implementació del controlador `NotificationController` per gestionar la vista de notificacions.
    - Afegida la ruta `/notifications` al fitxer `routes/web.php`.

2. **Tests de Notificacions**
    - Afegits tests per verificar el comportament de les notificacions:
        - `test_video_created_event_is_dispatched`: Comprova que l'esdeveniment `VideoCreated` es dispara quan es crea un vídeo.
        - `test_push_notification_is_sent_when_video_is_created`: Comprova que s'envia una notificació push quan es crea un vídeo.

3. **Millores Generals**
    - Compilació dels assets amb Laravel Mix per assegurar el correcte funcionament de les notificacions en temps real.
    - Revisió i actualització de la documentació per incloure les noves funcionalitats implementades.

