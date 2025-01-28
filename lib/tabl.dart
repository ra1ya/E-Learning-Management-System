import 'package:flutter/cupertino.dart';
import 'package:flutter/material.dart';

class Tabl extends StatefulWidget {
  const Tabl({super.key});

  @override
  State<Tabl> createState() => _TablState();
}

class _TablState extends State<Tabl> {
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: Colors.amber,
      appBar: AppBar(
        title: Text('الجداول'),
        centerTitle: true,
        backgroundColor: Colors.amber,
      ),
      body: Center(
        child: Image.asset("assets/images/tables.jpg",height: 1250,width: 1250,),
      ),
    );
  }
}
