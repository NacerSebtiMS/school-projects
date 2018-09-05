actionsPossibles(L,R) :-
    scrib(L),clean(),scrib(L),
    findall(move(X,Y,Z),move(X,Y,Z),MoveIt),
    findall(moveToTable(A,B),moveToTable(A,B),MoveTT),
    append(MoveIt,MoveTT,R),
    clean().

scrib([]).
scrib([X|Z]) :- assertz(X),scrib(Z).

clean() :-
    findall(on(O,N),on(O,N),Ons),
    findall(clear(C),clear(C),Clears),
    findall(block(B),block(B),Blocks),
    cc(Ons),cc(Clears),cc(Blocks).

cc([]).
cc([X|Z]) :- retract(X),cc(Z).


move(X,F,T) :-
    block(X),block(T),
    clear(X), clear(T),
    on(X,F),not(X=F),not(X=T),not(F=T).

moveToTable(X,F) :-
    block(X),
    clear(X),
    on(X,F),not(X=F),not(F=table).
