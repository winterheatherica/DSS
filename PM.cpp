#include <iostream>

using namespace std;

int Aspect;
float Factor[100][3][100];

int Alt;
float ArrAlt[100][100][100];
float ArrAlt2[100][100][100];
float ArrAlt3[100][100][100];

int main (){

    cin >> Aspect;

    for (int i=0; i < Aspect; i++){
        cin >> Factor[i][0][0];
    }

    for (int i=0; i < Aspect; i++){
        for (int j=0; j < Factor[i][0][0]; j++){
            cin >> Factor[i][1][j] >> Factor[i][2][j];
        }
    }

    for (int i=0; i < Aspect; i++){
        for (int j=0; j < Factor[i][0][0]; j++){
            cout << Factor[i][1][j] << " " << Factor[i][2][j] << endl;
        }
        cout << endl;
    }

    cin >> Alt;

    for (int i=0; i < Aspect; i++){
        for (int j=0; j < Alt; j++){
            for (int k=0; k < Factor[i][0][0]; k++){
                cin >> ArrAlt[i][j][k];
            }
        }
    }

    for (int i=0; i < Aspect; i++){
        for (int j=0; j < Alt; j++){
            for (int k=0; k < Factor[i][0][0]; k++){
                cout << ArrAlt[i][j][k] << " ";
            }
            cout << endl;
        }
        cout << endl;
    }

    for (int i=0; i < Aspect; i++){
        for (int j=0; j < Alt; j++){
            for (int k=0; k < Factor[i][0][0]; k++){
                ArrAlt2[i][j][k] = ArrAlt[i][j][k] - Factor[i][1][k];
            }
        }
    }

    for (int i=0; i < Aspect; i++){
        for (int j=0; j < Alt; j++){
            for (int k=0; k < Factor[i][0][0]; k++){
                cout << ArrAlt2[i][j][k] << " ";
            }
            cout << endl;
        }
        cout << endl;
    }

    for (int i=0; i < Aspect; i++){
        for (int j=0; j < Alt; j++){
            for (int k=0; k < Factor[i][0][0]; k++){
                if(ArrAlt2[i][j][k] == 0){
                    ArrAlt3[i][j][k] = 5;
                } else if(ArrAlt2[i][j][k] == 1){
                    ArrAlt3[i][j][k] = 4.5;
                } else if(ArrAlt2[i][j][k] == 2){
                    ArrAlt3[i][j][k] = 3.5;
                } else if(ArrAlt2[i][j][k] == 3){
                    ArrAlt3[i][j][k] = 2.5;
                } else if(ArrAlt2[i][j][k] == 4){
                    ArrAlt3[i][j][k] = 1.5;
                } else if(ArrAlt2[i][j][k] == -1){
                    ArrAlt3[i][j][k] = 4;
                } else if(ArrAlt2[i][j][k] == -2){
                    ArrAlt3[i][j][k] = 3;
                } else if(ArrAlt2[i][j][k] == -3){
                    ArrAlt3[i][j][k] = 2;
                } else if(ArrAlt2[i][j][k] == -4){
                    ArrAlt3[i][j][k] = 1;
                }
            }
        }
    }

    for (int i=0; i < Aspect; i++){
        for (int j=0; j < Alt; j++){
            for (int k=0; k < Factor[i][0][0]; k++){
                cout << ArrAlt3[i][j][k] << " ";
            }
            cout << endl;
        }
        cout << endl;
    }

    

}