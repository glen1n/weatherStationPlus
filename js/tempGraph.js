function Fahrenheit(vv) { 
    return("<nobr>"+Math.round(vv*18+320)/10+"° F</nobr>"); 
}
    document.open();
    var D=new Diagram();
    D.SetFrame(80, 160, 520, 360);
    D.SetBorder(6, 18, 20, 30);
    D.SetText("","", "temperature measured during the day");
    D.XScale=" h";
    D.YScale="° C";
    D.SetGridColor("#cccccc");
    D.Draw("#FFEECC", "#663300", false);
    var t, T0, T1;
    D.GetYGrid();
_   BFont="font-family:Verdana;font-size:10pt;line-height:13pt;";
    for (t=D.YGrid[0]; t<=D.YGrid[2]; t+=D.YGrid[1])
        new Bar(D.right+6, D.ScreenY(t)-8, D.right+6, D.ScreenY(t)+8, "", Fahrenheit(t), "#663300");
    T1=22;
    for (t=6; t<18; t++) { 
        T0=T1;
        T1=23-4*Math.cos(t/4)+Math.random();
        new Line(D.ScreenX(t), 
        D.ScreenY(T0), 
        D.ScreenX(t+1), 
        D.ScreenY(T1), 
        "#cc9966", 2, 
        "temperature");
    }
    document.close();
