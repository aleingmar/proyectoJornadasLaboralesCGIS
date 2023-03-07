PARA CREAR MODELOS, MIGRACIONES...
./vendor/bin sail php artisan make:model Medico --all





DUDAS:

1->Entidad user
getTipousuarioidAttribute(),
Todos los metodos querys que he hecho en los modelos y la sintaxis :: o -> 
                                                                    metodos terminados en () o sin nada
                                                                    diferencia entre get() y all()


2-> Si en mi proyecto hay varios perfiles distinto con distintas funcionalidades entre ellos (medico normal, jefe de guardia)
Tengo que separarlos?? Ahora mismo se diferencian en la tabla cargo

3-> Quiero que un médico que sea jefe de guardia -> tenga dos usuarios uno como jefe de guardia y otro como médico normal

4->Personal_SanitarioController  
$personal_sanitario = new PersonalSanitario($request->all());

5-> RUTAS

6-> //DUDA -> pk en el show se le pasa el listado de cargos y profesiones (profesional_sanitario)
