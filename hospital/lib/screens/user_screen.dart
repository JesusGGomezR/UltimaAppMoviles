import 'package:flutter/material.dart';
import 'package:provider/provider.dart';
import 'package:hospital/provider/user_provider.dart';
import '../models/user_model.dart';
import 'edituser_screen.dart';

class EditUserScreen extends StatefulWidget {
  @override
  _EditUserScreenState createState() => _EditUserScreenState();
}

class _EditUserScreenState extends State<EditUserScreen> {
  final TextEditingController nombreController = TextEditingController();
  final TextEditingController curpController = TextEditingController();
  final TextEditingController correoController = TextEditingController();
  final TextEditingController contrasenaController = TextEditingController();

  @override
  void initState() {
    super.initState();
    // Cargar los datos del usuario al iniciar la pantalla
    Provider.of<UserProvider>(context, listen: false).loadUserData();
  }

  @override
  Widget build(BuildContext context) {
    final userProvider = Provider.of<UserProvider>(context);

    return Scaffold(
      appBar: AppBar(
        title: Text('Editar Usuario'),
        backgroundColor: Color.fromARGB(255, 27, 89, 121),
        leading: IconButton(
          icon: Icon(Icons.arrow_back),
          onPressed: () {
            try {
              // Navegar de regreso cuando se presiona el botón de retroceso
              Navigator.pushReplacementNamed(context, 'home');
            } catch (e) {
              print('Error al regresar: $e');
            }
          },
        ),
      ),
      body: FutureBuilder<List<User>>(
        future: userProvider.getUsers(),
        builder: (context, snapshot) {
          if (snapshot.connectionState == ConnectionState.waiting) {
            return Center(child: CircularProgressIndicator());
          } else if (snapshot.hasError) {
            return Center(child: Text('Error al cargar usuarios'));
          } else if (!snapshot.hasData || snapshot.data!.isEmpty) {
            return Center(child: Text('No hay usuarios disponibles'));
          } else {
            return ListView.builder(
              itemCount: snapshot.data!.length,
              itemBuilder: (context, index) {
                User user = snapshot.data![index];

                return listaUsers(user, context);
              },
            );
          }
        },
      ),
    );
  }

  ListTile listaUsers(User user, BuildContext context) {
    final userProvider = Provider.of<UserProvider>(context);
    return ListTile(
      title: Text(
        user.nombre ?? '',
        style: TextStyle(
          fontWeight: FontWeight.bold,
          fontSize: 16,
        ),
      ),
      subtitle: Text(
        user.correo ?? '',
        style: TextStyle(
          fontStyle: FontStyle.italic,
          fontSize: 14,
        ),
      ),
      trailing: Row(
        mainAxisSize: MainAxisSize.min,
        children: [
          SizedBox(
            width: 80,
            child: ElevatedButton(
              onPressed: () {
                // Navegar a la pantalla de edición con el usuario seleccionado
                Navigator.push(
                  context,
                  MaterialPageRoute(
                    builder: (context) => EditUserDetailsScreen(user: user),
                  ),
                );
              },
              style: ElevatedButton.styleFrom(
                primary: Color.fromARGB(
                    255, 27, 89, 121), // Color de fondo del botón
              ),
              child: Text(
                'Editar',
                style: TextStyle(
                  fontSize: 14,
                ),
              ),
            ),
          ),
          SizedBox(width: 8), // Añadir un espacio entre los botones
          SizedBox(
            width: 80,
            child: ElevatedButton(
              onPressed: () async {
                // Lógica para eliminar el usuario
                try {
                  // Llama a la función deleteUser del UserProvider
                  await userProvider.deleteUser(user.id);
                  // Recarga la lista después de eliminar el usuario
                  await userProvider.loadUserData();
                } catch (e) {
                  print('Error al eliminar el usuario: $e');
                  // Puedes manejar el error según tus necesidades
                }
              },
              style: ElevatedButton.styleFrom(
                primary: Colors.red, // Color de fondo del botón de eliminar
              ),
              child: Text(
                'Eliminar',
                style: TextStyle(
                  fontSize: 14,
                ),
              ),
            ),
          ),
        ],
      ),
    );
  }
}
