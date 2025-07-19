.386

code SEGMENT para USE16 PUBLIC 'code'
	ASSUME CS:code, DS:data, SS:stack
	START:
		;clear
		mov ax, 3
		int 10h

		;32 bit registers

		in al, 92h
		or al, 2
		out 92h, al

		;echo result

		xor eax, eax

		jmp fill

		redraw:
			mov ax, VID_BUF ; set video pointer
			mov es, ax
			xor di, di ; clear addr
			mov cx, VID_SZ
			mov al, fill_color
			inc al
			mov fill_color, al
			jmp fill
		fill:
			stosb ; ES:DI = fill_color value (al)
			loop fill
		; wait ESC
			push ax
			in al, 60h
			dec al
			pop ax
			jnz redraw ; if !ESC key, goto main
		; return 2 text mode:
			mov ax, 3h
			int 10h
		; exit:
			mov ah, 4Ch
			int 21h
			ret
code ends

data SEGMENT  para USE16 PUBLIC 'data'
	fill_color db ?
	MX dw 320
	MY dw 200
	VID_SZ dw 64000
	VID_BUF dw 0A000h
data ends

stack SEGMENT para USE16 PUBLIC 'stack'
	; Data goes here ...
stack ends