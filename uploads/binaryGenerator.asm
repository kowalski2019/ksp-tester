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
	asf	9
	call	_newStringMaker
	pushr
	popl	5
	call	_newCharList
	pushr
	popl	0
	call	_newCharList
	pushr
	popl	1
	call	_newCharList
	pushr
	popl	2
	call	_newCharList
	pushr
	popl	3
	call	_newCharList
	pushr
	popl	4
	pushl	0
	pushc	104
	call	_cAdd
	drop	2
	pushl	0
	pushc	97
	call	_cAdd
	drop	2
	pushl	0
	pushc	108
	call	_cAdd
	drop	2
	pushl	0
	pushc	108
	call	_cAdd
	drop	2
	pushl	0
	pushc	111
	call	_cAdd
	drop	2
	pushl	0
	pushc	32
	call	_cAdd
	drop	2
	pushl	1
	pushc	119
	call	_cAdd
	drop	2
	pushl	1
	pushc	105
	call	_cAdd
	drop	2
	pushl	1
	pushc	101
	call	_cAdd
	drop	2
	pushl	1
	pushc	32
	call	_cAdd
	drop	2
	pushl	2
	pushc	103
	call	_cAdd
	drop	2
	pushl	2
	pushc	101
	call	_cAdd
	drop	2
	pushl	2
	pushc	104
	call	_cAdd
	drop	2
	pushl	2
	pushc	116
	call	_cAdd
	drop	2
	pushl	2
	pushc	32
	call	_cAdd
	drop	2
	pushl	3
	pushc	101
	call	_cAdd
	drop	2
	pushl	3
	pushc	115
	call	_cAdd
	drop	2
	pushl	3
	pushc	32
	call	_cAdd
	drop	2
	pushl	4
	pushc	100
	call	_cAdd
	drop	2
	pushl	4
	pushc	105
	call	_cAdd
	drop	2
	pushl	4
	pushc	114
	call	_cAdd
	drop	2
	pushl	5
	pushl	0
	call	_sAdd
	drop	2
	pushl	5
	pushl	1
	call	_sAdd
	drop	2
	pushl	5
	pushl	2
	call	_sAdd
	drop	2
	pushl	5
	pushl	3
	call	_sAdd
	drop	2
	pushl	5
	pushl	4
	call	_sAdd
	drop	2
	pushc	0
	popl	6
	jmp	__2
__1:
	pushc	0
	popl	7
	jmp	__5
__4:
	pushl	5
	pushl	6
	call	_sGet
	drop	2
	pushr
	pushl	7
	call	_cGet
	drop	2
	pushr
	call	_writeCharacter
	drop	1
	pushl	7
	pushc	1
	add
	popl	7
__5:
	pushl	7
	pushl	5
	pushl	6
	call	_sGet
	drop	2
	pushr
	call	_cGetSize
	drop	1
	pushr
	lt
	brt	__4
__6:
	pushl	6
	pushc	1
	add
	popl	6
__2:
	pushl	6
	pushl	5
	call	_sGetSize
	drop	1
	pushr
	lt
	brt	__1
__3:
	pushc	10
	call	_writeCharacter
	drop	1
	pushc	8
	call	_binaryGenerator
	drop	1
__0:
	rsf
	ret

//
// Integer power(Integer, Integer)
//
_power:
	asf	1
	pushl	-4
	popl	0
	pushl	-3
	pushc	0
	eq
	brf	__8
	pushc	1
	popr
	jmp	__7
__8:
	jmp	__10
__9:
	pushl	-4
	pushl	0
	mul
	popl	-4
	pushl	-3
	pushc	1
	sub
	popl	-3
__10:
	pushl	-3
	pushc	1
	gt
	brt	__9
__11:
	pushl	-4
	popr
	jmp	__7
__7:
	rsf
	ret

//
// record { Integer[] array; Integer capacity; Integer in; } newIntList()
//
_newIntList:
	asf	1
	new	3
	popl	0
	pushl	0
	pushc	0
	putf	2
	pushl	0
	pushc	1000
	newa
	putf	0
	pushl	0
	pushc	1000
	putf	1
	pushl	0
	popr
	jmp	__12
__12:
	rsf
	ret

//
// void add(record { Integer[] array; Integer capacity; Integer in; }, Integer)
//
_add:
	asf	1
	pushl	-4
	getf	2
	popl	0
	pushl	0
	pushl	-4
	getf	1
	eq
	brf	__14
	pushl	-4
	call	_increaseSize
	drop	1
	pushr
	popl	-4
__14:
	pushl	-4
	getf	0
	pushl	0
	pushl	-3
	putfa
	pushl	-4
	pushl	-4
	getf	2
	pushc	1
	add
	putf	2
__13:
	rsf
	ret

//
// Integer get(record { Integer[] array; Integer capacity; Integer in; }, Integer)
//
_get:
	asf	0
	pushl	-3
	pushl	-4
	getf	1
	eq
	brf	__16
	pushc	0
	pushc	1
	sub
	popr
	jmp	__15
__16:
	pushl	-3
	pushc	0
	lt
	brf	__17
	pushc	0
	pushc	1
	sub
	popr
	jmp	__15
__17:
	pushl	-4
	call	_isEmpty
	drop	1
	pushr
	brf	__18
	pushc	0
	pushc	1
	sub
	popr
	jmp	__15
__18:
	pushl	-4
	getf	0
	pushl	-3
	getfa
	popr
	jmp	__15
__15:
	rsf
	ret

//
// Integer getSize(record { Integer[] array; Integer capacity; Integer in; })
//
_getSize:
	asf	0
	pushl	-3
	getf	2
	popr
	jmp	__19
__19:
	rsf
	ret

//
// Boolean remove(record { Integer[] array; Integer capacity; Integer in; }, Integer)
//
_remove:
	asf	2
	pushl	-3
	pushl	-4
	getf	1
	eq
	brf	__21
	pushc	0
	popr
	jmp	__20
__21:
	pushl	-3
	pushc	0
	lt
	brf	__22
	pushc	0
	popr
	jmp	__20
__22:
	pushl	-3
	popl	0
	jmp	__24
__23:
	pushl	0
	pushc	1
	add
	popl	1
	pushl	-4
	getf	0
	pushl	0
	pushl	-4
	getf	0
	pushl	1
	getfa
	putfa
	pushl	0
	pushc	1
	add
	popl	0
__24:
	pushl	0
	pushl	-4
	getf	1
	lt
	brt	__23
__25:
	pushl	-4
	pushl	-4
	getf	2
	pushc	1
	sub
	putf	2
	pushc	1
	popr
	jmp	__20
__20:
	rsf
	ret

//
// record { Integer[] array; Integer capacity; Integer in; } increaseSize(record { Integer[] array; Integer capacity; Integer in; })
//
_increaseSize:
	asf	3
	pushl	-3
	getf	1
	pushl	-3
	getf	1
	mul
	popl	1
	pushl	1
	newa
	popl	0
	pushl	-3
	pushl	0
	putf	0
	pushl	-3
	pushl	1
	putf	1
	pushl	-3
	popr
	jmp	__26
__26:
	rsf
	ret

//
// Boolean isEmpty(record { Integer[] array; Integer capacity; Integer in; })
//
_isEmpty:
	asf	0
	pushl	-3
	getf	2
	pushc	0
	eq
	brf	__28
	pushc	1
	popr
	jmp	__27
__28:
	pushc	0
	popr
	jmp	__27
__27:
	rsf
	ret

//
// void iClear(record { Integer[] array; Integer capacity; Integer in; })
//
_iClear:
	asf	0
	call	_newIntList
	pushr
	popl	-3
__29:
	rsf
	ret

//
// record { CharList[] buffer; Integer capacity; Integer in; } newStringMaker()
//
_newStringMaker:
	asf	1
	new	3
	popl	0
	pushl	0
	pushc	0
	putf	2
	pushl	0
	pushc	1000
	newa
	putf	0
	pushl	0
	pushc	1000
	putf	1
	pushl	0
	popr
	jmp	__30
__30:
	rsf
	ret

//
// record { Character[] array; Integer capacity; Integer in; } sGet(record { CharList[] buffer; Integer capacity; Integer in; }, Integer)
//
_sGet:
	asf	0
	pushl	-3
	pushl	-4
	getf	1
	eq
	brf	__32
	call	_newCharList
	pushr
	popr
	jmp	__31
__32:
	pushl	-3
	pushc	0
	lt
	brf	__33
	call	_newCharList
	pushr
	popr
	jmp	__31
__33:
	pushl	-4
	call	_sIsEmpty
	drop	1
	pushr
	brf	__34
	call	_newCharList
	pushr
	popr
	jmp	__31
__34:
	pushl	-4
	getf	0
	pushl	-3
	getfa
	popr
	jmp	__31
__31:
	rsf
	ret

//
// void sAdd(record { CharList[] buffer; Integer capacity; Integer in; }, record { Character[] array; Integer capacity; Integer in; })
//
_sAdd:
	asf	2
	call	_newCharList
	pushr
	popl	0
	pushl	-4
	getf	2
	popl	1
	pushl	0
	pushl	-3
	getf	0
	putf	0
	pushl	0
	pushl	-3
	getf	2
	putf	2
	pushl	1
	pushl	-4
	getf	1
	eq
	brf	__36
	pushl	-4
	call	_sIncreaseSize
	drop	1
	pushr
	popl	-4
__36:
	pushl	-4
	getf	0
	pushl	1
	pushl	0
	putfa
	pushl	-4
	pushl	-4
	getf	2
	pushc	1
	add
	putf	2
__35:
	rsf
	ret

//
// Integer sGetSize(record { CharList[] buffer; Integer capacity; Integer in; })
//
_sGetSize:
	asf	0
	pushl	-3
	getf	2
	popr
	jmp	__37
__37:
	rsf
	ret

//
// Boolean sRemove(record { CharList[] buffer; Integer capacity; Integer in; }, Integer)
//
_sRemove:
	asf	2
	pushl	-3
	pushl	-4
	getf	1
	eq
	brf	__39
	pushc	0
	popr
	jmp	__38
__39:
	pushl	-3
	pushc	0
	lt
	brf	__40
	pushc	0
	popr
	jmp	__38
__40:
	pushl	-3
	popl	0
	jmp	__42
__41:
	pushl	0
	pushc	1
	add
	popl	1
	pushl	-4
	getf	0
	pushl	0
	pushl	-4
	getf	0
	pushl	1
	getfa
	putfa
	pushl	0
	pushc	1
	add
	popl	0
__42:
	pushl	0
	pushl	-4
	getf	1
	lt
	brt	__41
__43:
	pushl	-4
	pushl	-4
	getf	2
	pushc	1
	sub
	putf	2
	pushc	1
	popr
	jmp	__38
__38:
	rsf
	ret

//
// record { CharList[] buffer; Integer capacity; Integer in; } sIncreaseSize(record { CharList[] buffer; Integer capacity; Integer in; })
//
_sIncreaseSize:
	asf	3
	pushl	-3
	getf	1
	pushl	-3
	getf	1
	mul
	popl	1
	pushl	1
	newa
	popl	0
	pushl	-3
	pushl	0
	putf	0
	pushl	-3
	pushl	1
	putf	1
	pushl	-3
	popr
	jmp	__44
__44:
	rsf
	ret

//
// Boolean sIsEmpty(record { CharList[] buffer; Integer capacity; Integer in; })
//
_sIsEmpty:
	asf	0
	pushl	-3
	getf	2
	pushc	0
	eq
	brf	__46
	pushc	1
	popr
	jmp	__45
__46:
	pushc	0
	popr
	jmp	__45
__45:
	rsf
	ret

//
// void sClear(record { CharList[] buffer; Integer capacity; Integer in; })
//
_sClear:
	asf	0
	call	_newStringMaker
	pushr
	popl	-3
__47:
	rsf
	ret

//
// record { Character[] array; Integer capacity; Integer in; } newCharList()
//
_newCharList:
	asf	1
	new	3
	popl	0
	pushl	0
	pushc	0
	putf	2
	pushl	0
	pushc	1000
	newa
	putf	0
	pushl	0
	pushc	1000
	putf	1
	pushl	0
	popr
	jmp	__48
__48:
	rsf
	ret

//
// void cAdd(record { Character[] array; Integer capacity; Integer in; }, Character)
//
_cAdd:
	asf	1
	pushl	-4
	getf	2
	popl	0
	pushl	0
	pushl	-4
	getf	1
	eq
	brf	__50
	pushl	-4
	call	_cIncreaseSize
	drop	1
	pushr
	popl	-4
__50:
	pushl	-4
	getf	0
	pushl	0
	pushl	-3
	putfa
	pushl	-4
	pushl	-4
	getf	2
	pushc	1
	add
	putf	2
__49:
	rsf
	ret

//
// Character cGet(record { Character[] array; Integer capacity; Integer in; }, Integer)
//
_cGet:
	asf	0
	pushl	-3
	pushl	-4
	getf	1
	eq
	brf	__52
	pushc	36
	popr
	jmp	__51
__52:
	pushl	-3
	pushc	0
	lt
	brf	__53
	pushc	36
	popr
	jmp	__51
__53:
	pushl	-4
	call	_cIsEmpty
	drop	1
	pushr
	brf	__54
	pushc	36
	popr
	jmp	__51
__54:
	pushl	-4
	getf	0
	pushl	-3
	getfa
	popr
	jmp	__51
__51:
	rsf
	ret

//
// Integer cGetSize(record { Character[] array; Integer capacity; Integer in; })
//
_cGetSize:
	asf	0
	pushl	-3
	getf	2
	popr
	jmp	__55
__55:
	rsf
	ret

//
// Boolean cRemove(record { Character[] array; Integer capacity; Integer in; }, Integer)
//
_cRemove:
	asf	2
	pushl	-3
	pushl	-4
	getf	1
	eq
	brf	__57
	pushc	0
	popr
	jmp	__56
__57:
	pushl	-3
	pushc	0
	lt
	brf	__58
	pushc	0
	popr
	jmp	__56
__58:
	pushl	-3
	popl	0
	jmp	__60
__59:
	pushl	0
	pushc	1
	add
	popl	1
	pushl	-4
	getf	0
	pushl	0
	pushl	-4
	getf	0
	pushl	1
	getfa
	putfa
	pushl	0
	pushc	1
	add
	popl	0
__60:
	pushl	0
	pushl	-4
	getf	1
	lt
	brt	__59
__61:
	pushl	-4
	pushl	-4
	getf	2
	pushc	1
	sub
	putf	2
	pushc	1
	popr
	jmp	__56
__56:
	rsf
	ret

//
// record { Character[] array; Integer capacity; Integer in; } cIncreaseSize(record { Character[] array; Integer capacity; Integer in; })
//
_cIncreaseSize:
	asf	3
	pushl	-3
	getf	1
	pushl	-3
	getf	1
	mul
	popl	1
	pushl	1
	newa
	popl	0
	pushl	-3
	pushl	0
	putf	0
	pushl	-3
	pushl	1
	putf	1
	pushl	-3
	popr
	jmp	__62
__62:
	rsf
	ret

//
// Boolean cIsEmpty(record { Character[] array; Integer capacity; Integer in; })
//
_cIsEmpty:
	asf	0
	pushl	-3
	getf	2
	pushc	0
	eq
	brf	__64
	pushc	1
	popr
	jmp	__63
__64:
	pushc	0
	popr
	jmp	__63
__63:
	rsf
	ret

//
// record { Character[] array; Integer capacity; Integer in; } cClear(record { Character[] array; Integer capacity; Integer in; })
//
_cClear:
	asf	0
	pushl	-3
	pushc	0
	putf	2
	pushl	-3
	popr
	jmp	__65
__65:
	rsf
	ret

//
// void binaryGenerator(Integer)
//
_binaryGenerator:
	asf	16
	pushc	2
	pushl	-3
	call	_power
	drop	2
	pushr
	popl	4
	pushl	-3
	popl	5
	pushl	4
	newa
	popl	9
	pushc	0
	popl	8
	jmp	__68
__67:
	pushl	9
	pushl	8
	pushl	5
	newa
	putfa
	pushl	8
	pushc	1
	add
	popl	8
__68:
	pushl	8
	pushl	4
	lt
	brt	__67
__69:
	call	_newCharList
	pushr
	popl	10
	call	_newCharList
	pushr
	popl	11
	call	_newStringMaker
	pushr
	popl	15
	pushc	0
	popl	3
	pushc	0
	popl	0
	pushl	-3
	pushc	1
	sub
	popl	-3
	jmp	__71
__70:
	pushc	2
	pushl	0
	call	_power
	drop	2
	pushr
	popl	1
	jmp	__74
__73:
	pushc	0
	popl	6
	jmp	__77
__76:
	pushl	11
	pushc	48
	call	_cAdd
	drop	2
	pushl	6
	pushc	1
	add
	popl	6
__77:
	pushl	6
	pushc	2
	pushl	-3
	call	_power
	drop	2
	pushr
	lt
	brt	__76
__78:
	pushc	0
	popl	6
	jmp	__80
__79:
	pushl	11
	pushc	49
	call	_cAdd
	drop	2
	pushl	6
	pushc	1
	add
	popl	6
__80:
	pushl	6
	pushc	2
	pushl	-3
	call	_power
	drop	2
	pushr
	lt
	brt	__79
__81:
	pushl	3
	pushc	1
	add
	popl	3
__74:
	pushl	3
	pushl	1
	lt
	brt	__73
__75:
	pushc	0
	popl	6
	pushl	11
	call	_cGetSize
	drop	1
	pushr
	popl	14
	jmp	__83
__82:
	pushl	9
	pushl	6
	getfa
	pushl	0
	pushl	11
	pushl	6
	call	_cGet
	drop	2
	pushr
	putfa
	pushl	6
	pushc	1
	add
	popl	6
__83:
	pushl	6
	pushl	14
	lt
	brt	__82
__84:
	pushl	11
	call	_cClear
	drop	1
	pushr
	popl	11
	pushc	0
	popl	3
	pushl	0
	pushc	1
	add
	popl	0
	pushl	-3
	pushc	1
	sub
	popl	-3
__71:
	pushl	-3
	pushc	0
	ge
	brt	__70
__72:
	pushc	18
	newa
	dup
	pushc	0
	pushc	99
	putfa
	dup
	pushc	1
	pushc	111
	putfa
	dup
	pushc	2
	pushc	109
	putfa
	dup
	pushc	3
	pushc	98
	putfa
	dup
	pushc	4
	pushc	105
	putfa
	dup
	pushc	5
	pushc	110
	putfa
	dup
	pushc	6
	pushc	97
	putfa
	dup
	pushc	7
	pushc	116
	putfa
	dup
	pushc	8
	pushc	105
	putfa
	dup
	pushc	9
	pushc	111
	putfa
	dup
	pushc	10
	pushc	110
	putfa
	dup
	pushc	11
	pushc	32
	putfa
	dup
	pushc	12
	pushc	99
	putfa
	dup
	pushc	13
	pushc	104
	putfa
	dup
	pushc	14
	pushc	101
	putfa
	dup
	pushc	15
	pushc	99
	putfa
	dup
	pushc	16
	pushc	107
	putfa
	dup
	pushc	17
	pushc	10
	putfa
	call	_writeString
	drop	1
	pushc	0
	popl	6
	jmp	__86
__85:
	pushc	0
	popl	7
	jmp	__89
__88:
	pushl	10
	pushl	9
	pushl	6
	getfa
	pushl	7
	getfa
	call	_cAdd
	drop	2
	pushl	7
	pushc	1
	add
	popl	7
__89:
	pushl	7
	pushl	5
	lt
	brt	__88
__90:
	pushl	15
	pushl	10
	call	_sAdd
	drop	2
	pushl	10
	call	_cClear
	drop	1
	pushr
	popl	10
	pushl	6
	pushc	1
	add
	popl	6
__86:
	pushl	6
	pushl	4
	lt
	brt	__85
__87:
	pushc	0
	popl	6
	pushc	17
	newa
	dup
	pushc	0
	pushc	98
	putfa
	dup
	pushc	1
	pushc	105
	putfa
	dup
	pushc	2
	pushc	110
	putfa
	dup
	pushc	3
	pushc	97
	putfa
	dup
	pushc	4
	pushc	114
	putfa
	dup
	pushc	5
	pushc	121
	putfa
	dup
	pushc	6
	pushc	67
	putfa
	dup
	pushc	7
	pushc	111
	putfa
	dup
	pushc	8
	pushc	109
	putfa
	dup
	pushc	9
	pushc	112
	putfa
	dup
	pushc	10
	pushc	32
	putfa
	dup
	pushc	11
	pushc	99
	putfa
	dup
	pushc	12
	pushc	104
	putfa
	dup
	pushc	13
	pushc	101
	putfa
	dup
	pushc	14
	pushc	99
	putfa
	dup
	pushc	15
	pushc	107
	putfa
	dup
	pushc	16
	pushc	10
	putfa
	call	_writeString
	drop	1
	jmp	__92
__91:
	pushl	6
	call	_writeInteger
	drop	1
	pushc	2
	newa
	dup
	pushc	0
	pushc	58
	putfa
	dup
	pushc	1
	pushc	32
	putfa
	call	_writeString
	drop	1
	pushc	0
	popl	7
	jmp	__95
__94:
	pushl	15
	pushl	6
	call	_sGet
	drop	2
	pushr
	pushl	7
	call	_cGet
	drop	2
	pushr
	call	_writeCharacter
	drop	1
	pushl	7
	pushc	1
	add
	popl	7
__95:
	pushl	7
	pushl	15
	pushl	6
	call	_sGet
	drop	2
	pushr
	call	_cGetSize
	drop	1
	pushr
	lt
	brt	__94
__96:
	pushc	10
	call	_writeCharacter
	drop	1
	pushl	6
	pushc	1
	add
	popl	6
__92:
	pushl	6
	pushl	15
	call	_sGetSize
	drop	1
	pushr
	lt
	brt	__91
__93:
	pushc	19
	newa
	dup
	pushc	0
	pushc	10
	putfa
	dup
	pushc	1
	pushc	45
	putfa
	dup
	pushc	2
	pushc	45
	putfa
	dup
	pushc	3
	pushc	45
	putfa
	dup
	pushc	4
	pushc	69
	putfa
	dup
	pushc	5
	pushc	110
	putfa
	dup
	pushc	6
	pushc	100
	putfa
	dup
	pushc	7
	pushc	32
	putfa
	dup
	pushc	8
	pushc	111
	putfa
	dup
	pushc	9
	pushc	102
	putfa
	dup
	pushc	10
	pushc	32
	putfa
	dup
	pushc	11
	pushc	67
	putfa
	dup
	pushc	12
	pushc	111
	putfa
	dup
	pushc	13
	pushc	100
	putfa
	dup
	pushc	14
	pushc	101
	putfa
	dup
	pushc	15
	pushc	45
	putfa
	dup
	pushc	16
	pushc	45
	putfa
	dup
	pushc	17
	pushc	45
	putfa
	dup
	pushc	18
	pushc	10
	putfa
	call	_writeString
	drop	1
__66:
	rsf
	ret
