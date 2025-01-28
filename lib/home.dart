import 'package:flutter/cupertino.dart';
import 'package:flutter/material.dart';
import 'package:learn/homeDesktop.dart';
import 'package:learn/homeTablet.dart';
import 'package:learn/home_mobile.dart';

import 'package:responsive_builder/responsive_builder.dart';

class Home extends StatefulWidget {
  const Home({super.key});

  @override
  State<Home> createState() => _HomeState();
}

class _HomeState extends State<Home> {
  @override
  Widget build(BuildContext context) {
    var deviceType = getDeviceType(MediaQuery.of(context).size);
    return Scaffold(
      appBar:deviceType ==DeviceScreenType.mobile?AppBar():null ,
      drawer:deviceType ==DeviceScreenType.mobile?Drawer(
        child: Container(color: Colors.red,),
      ):null,
      body: ScreenTypeLayout(
        mobile: Container(child: HomeMobile(),),
        tablet: Container(child: HomeTablet(),),

        desktop: Container(
          child: HomeDesktop(),
        ),

      ),

    );
  }
}
