//
// version
//
	.vers	8

//
// execution framework
//
__start:
	call	_main
	call	_exit
__stop:
	jmp	__stop

//
// Integer readInteger()
//
_readInteger:
	asf	0
	rdint
	popr
	rsf
	ret

//
// void writeInteger(Integer)
//
_writeInteger:
	asf	0
	pushl	-3
	wrint
	rsf
	ret

//
// Character readCharacter()
//
_readCharacter:
	asf	0
	rdchr
	popr
	rsf
	ret

//
// void writeCharacter(Character)
//
_writeCharacter:
	asf	0
	pushl	-3
	wrchr
	rsf
	ret

//
// Integer char2int(Character)
//
_char2int:
	asf	0
	pushl	-3
	popr
	rsf
	ret

//
// Character int2char(Integer)
//
_int2char:
	asf	0
	pushl	-3
	popr
	rsf
	ret

//
// void exit()
//
_exit:
	asf	0
	halt
	rsf
	ret

//
// void writeString(String)
//
_writeString:
	asf	1
	pushc	0
	popl	0
	jmp	_writeString_L2
_writeString_L1:
	pushl	-3
	pushl	0
	getfa
	call	_writeCharacter
	drop	1
	pushl	0
	pushc	1
	add
	popl	0
_writeString_L2:
	pushl	0
	pushl	-3
	getsz
	lt
	brt	_writeString_L1
	rsf
	ret

//
// void main()
//
_main:
	asf	1
	call	_readInteger
	pushr
	popl	0
	pushl	0
	call	_addfractions
	drop	1
__0:
	rsf
	ret

//
// void addfractions(Integer)
//
_addfractions:
	asf	5
	pushc	1
	popl	3
	pushl	3
	pushc	1
	add
	popl	4
	pushc	1
	popl	0
	pushl	3
	popl	1
	jmp	__3
__2:
	pushl	1
	pushl	4
	ne
	brf	__5
	pushl	0
	pushl	4
	mul
	pushl	1
	pushc	1
	mul
	add
	popl	0
	pushl	1
	pushl	4
	mul
	popl	1
	jmp	__6
__5:
	pushl	0
	pushc	1
	add
	popl	0
	pushl	1
	popl	1
__6:
	pushl	0
	pushl	1
	call	_ggT
	drop	2
	pushr
	popl	2
	pushl	0
	pushl	2
	div
	popl	0
	pushl	1
	pushl	2
	div
	popl	1
	pushl	3
	pushc	1
	add
	popl	3
	pushl	4
	pushc	1
	add
	popl	4
__3:
	pushl	3
	pushl	-3
	lt
	brt	__2
__4:
	pushl	0
	call	_writeInteger
	drop	1
	pushc	32
	call	_writeCharacter
	drop	1
	pushc	47
	call	_writeCharacter
	drop	1
	pushc	32
	call	_writeCharacter
	drop	1
	pushl	1
	call	_writeInteger
	drop	1
	pushc	10
	call	_writeCharacter
	drop	1
__1:
	rsf
	ret

//
// Integer ggT(Integer, Integer)
//
_ggT:
	asf	0
	jmp	__9
__8:
	pushl	-4
	pushl	-3
	gt
	brf	__11
	pushl	-4
	pushl	-3
	sub
	popl	-4
	jmp	__12
__11:
	pushl	-3
	pushl	-4
	sub
	popl	-3
__12:
__9:
	pushl	-4
	pushl	-3
	ne
	brt	__8
__10:
	pushl	-4
	popr
	jmp	__7
__7:
	rsf
	ret
