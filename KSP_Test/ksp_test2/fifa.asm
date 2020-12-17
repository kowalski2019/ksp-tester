//local Integer x;
//local Integer y;
//local Integer z;
//x=5;
//y=3;
//z=x+y;
//x=-3;
//y=-10;
//writeInteger(z+100);
//writeInteger(x+100);
//writeInteger(y+101);
//writeCharacter('\n');


asf      3
pushc    5
popl     0
pushl    0
pushc    3
popl     1
pushl    1
add
popl     2
pushl   2
pushc    -3
popl     0
pushc    -10
popl     1
pushc    100
add
wrint
pushl    0
pushc    100
add
wrint
//pushl    1
//pushc    101
//add
//wrint
pushc   '\n'
wrchr
rsf
halt
