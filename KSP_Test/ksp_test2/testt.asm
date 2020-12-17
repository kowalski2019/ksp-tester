        asf	3
	pushc   1
        popl    1
	pushc	10000
	popg	0
	pushc	5454
	wrint
        jmp     __2
__1:
        pushc   105
        wrchr
        pushc   110
        wrchr
        pushc   115
        wrchr
        pushc   101
        wrchr
        pushc   114
        wrchr
        pushc   116
        wrchr
        pushc   32
        wrchr
        pushc   97
        wrchr
        pushc   32
        wrchr
        pushc   110
        wrchr
        pushc   117
        pushc   109
        wrchr
        pushc   98
        wrchr
        pushc   101
        wrchr
        pushc   114
        wrchr
        pushc   58
        wrchr
        pushc   32
        wrchr
        rdint
        popl    0
        pushl   0
        pushc   100
        gt
        brf     __4
        pushc   0
        popl    1
        jmp     __5
__4:
        pushc   10
        wrchr
        pushc   121
        wrchr
        pushc   111
        wrchr
        pushc   117
        wrchr
        pushc   114
        wrchr
        pushc   32
        wrchr
        pushc   110
        wrchr
        pushc   117
        wrchr
        pushc   109
        wrchr
        pushc   98
        wrchr
        pushc   101
        wrchr
        pushc   114
        wrchr
        pushc   58
        wrchr
        pushc   32
        wrchr
        pushl   0
        wrint
        pushc   10
        wrchr
__5:
__2:
        pushl   1
        pushc   0
        ne
        brt     __1
__3:
        jmp     __7
__6:
        pushc   100
	wrchr      
        pushc   111
        wrchr
        pushc   119
        wrchr
        pushc   110
        wrchr
        pushc   32
        wrchr
        pushc   116
        wrchr
        pushc   111
        wrchr
        pushc   58
        wrchr
        pushc   32
        wrchr
        pushg   0
        wrint
        pushc   10
        wrchr
        pushg   0
        pushc   2
        sub
        popg    0
__7:
        pushg   0
        pushc   0
        gt
        brt     __6
__8:
__0:
	rsf
	halt
