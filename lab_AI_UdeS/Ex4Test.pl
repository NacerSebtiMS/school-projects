actionsPossibles(L,R) :-
    scrib(L),clean(),scrib(L),
    findall(move(X,Y,Z),move(X,Y,Z),MoveIt),
    findall(moveToTable(A,B),moveToTable(A,B),MoveTT),
    append(MoveIt,MoveTT,R),
    clean().

etatSuccesseur(L,X,R) :-
    scrib(L),clean(),scrib(L),
    eS(L,X,R).
eS(L,move(X,F,T),L) :-
    delete_in_set(on(X,F),L,L),
    delete_in_set(clear(T),L,L),

    add_in_set(on(X,T),L,L),
    add_in_set(clear(F),L,L).

eS(L,moveToTable(X,F),L) :-
    delete_in_set(on(X,F),L,L),
    write(L),
    append([on(X,table)],L,L),
    append([clear(F)],L,L),
    write(L).

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

delete_in_set(_, [], []) :- !.
delete_in_set(E, [E|T], T) :- !.
delete_in_set(E, [H|T], [H|Tnew]) :- delete_in_set(E,T,Tnew).

add_in_set(E, S, S) :- member(E,S), !.
add_in_set(E, S, [E|S]).
