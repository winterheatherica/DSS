#include <iostream>

using namespace std;

int Aspect;
float Factor[100][3][100];
float Nilai[100][3];

int Alt;
float ArrAlt[100][100][100];
float ArrAlt2[100][100][100];
float ArrAlt3[100][100][100];
float NilaiTotal[100][100];
float NilaiAkhir[100];

int main (){

    cin >> Aspect;

    for (int i=0; i < Aspect; i++){
        cin >> Factor[i][0][0] >> Nilai[i][0] >> Nilai[i][1] >> Nilai[i][2];
    }

    for (int i=0; i < Aspect; i++){
        for (int j=0; j < Factor[i][0][0]; j++){
            cin >> Factor[i][1][j] >> Factor[i][2][j];
        }
    }

    for (int i=0; i < Aspect; i++){
        for (int j=0; j < Factor[i][0][0]; j++){
            if (Factor[i][2][j] == 1){
                cout << Factor[i][1][j] << " " << "Core Factor" << endl;
            } else if (Factor[i][2][j] == 2){
                cout << Factor[i][1][j] << " " << "Secondary Factor"<< endl;
            }
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

    cout << "Menghitung GAP:" << endl;

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

    cout << "Penetapan Bobot:" << endl;

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

    for (int i=0; i < Aspect; i++){
        for (int j=0; j < Alt; j++){
            float jumlah_core = 0;
            float jumlah_second = 0;
            int frek_core = 0;
            int frek_second = 0;
            for (int k=0; k < Factor[i][0][0]; k++){
                if (Factor[i][2][k] == 1){
                    jumlah_core = jumlah_core + ArrAlt3[i][j][k];
                    frek_core++;
                } else if (Factor[i][2][k] == 2){
                    jumlah_second = jumlah_second + ArrAlt3[i][j][k];
                    frek_second++;
                }
            }
            NilaiTotal[j][i] = Nilai[i][1] * (jumlah_core/frek_core) + Nilai[i][2] * (jumlah_second/frek_second);
        }
    }

    cout << "Nilai Akhir:" << endl;

    float nilai_max = INT_MIN;

    for (int i=0; i < Alt; i++){
        float jumlah = 0;
        for (int j=0; j < Aspect; j++){
            jumlah = jumlah + Nilai[j][0] * NilaiTotal[i][j];
            
        }
        NilaiAkhir[i] = jumlah;
        cout << NilaiAkhir[i] << endl;
        if (NilaiAkhir[i] > nilai_max) nilai_max = NilaiAkhir[i];
    }
    cout << endl;

    cout << "Nilai Max nya: " << nilai_max;
}