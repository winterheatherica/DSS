#include <iostream>
#include <cmath>

using namespace std;

int Crit;
int Alt;

string bORc[100];
float minORmax[100];
float total;

float arr1[100];
float arr2[100][100];
float arr3[100][100];
float arr4[100];
float SAW[100];
float WP[100];
float WASPAS[100];

int main(){

    cin >> Crit;
    for (int i=0; i < Crit; i++){
        cin >> arr1[i] >> bORc[i];
    }

    cout << "Weight" << endl;
    for (int i=0; i < Crit; i++){
        cout << arr1[i] << " " << bORc[i] << endl;
    }

    cout << endl;

    cin >> Alt;
    for (int i=0; i < Alt; i++){
        for (int j=0; j < Crit; j++){
            cin >> arr2[i][j];
        }
    }

    cout << "Matriks Awal" << endl;
    for (int i=0; i < Alt; i++){
        for (int j=0; j < Crit; j++){
            cout << arr2[i][j] << " ";
        }
        cout << endl;
    }
    
    cout << endl;
    total = 0;
    for (int i=0; i < Crit; i++){
        total = total + arr1[i];
    }

    for (int i=0; i < Crit; i++){
        arr4[i] = arr1[i]/total;
    }

    // for (int i=0; i < Crit; i++){
    //     cout << arr4[i] << " " << bORc[i] << endl;
    // }

    for (int i=0; i < Crit; i++){
        float nilai_max = INT_MIN;
        float nilai_min = INT_MAX;
        if (bORc[i] == "b"){
            for (int j=0; j < Alt; j++){
                if (arr2[j][i] > nilai_max){
                    nilai_max = arr2[j][i];
                }
            }
            minORmax[i] = nilai_max;
        } else if (bORc[i] == "c"){
            for (int j=0; j < Alt; j++){
                if (arr2[j][i] < nilai_min){
                    nilai_min = arr2[j][i];
                }
            }
            minORmax[i] = nilai_min;
        }
    }

    cout << "Nilai (B)Maximum atau (C)Minimum tiap Criteria" << endl;
    for (int i=0; i < Crit; i++){
        cout << minORmax[i] << endl;
    }
    cout << endl;

    for (int i=0; i < Crit; i++){
        if (bORc[i] == "b"){
            for (int j=0; j < Alt; j++){
                arr3[j][i] = arr2[j][i]/minORmax[i];
            }
        } else if (bORc[i] == "c"){
            for (int j=0; j < Alt; j++){
                arr3[j][i] = minORmax[i]/arr2[j][i];
            }
        }
    }

    cout << "Matriks Normalisasi" << endl;
    for (int i=0; i < Alt; i++){
        for (int j=0; j < Crit; j++){
            cout << arr3[i][j] << " ";
        }
        cout << endl;
    }
    
    for (int i=0; i < Alt; i++){
        float jumlah = 0;
        for (int j=0; j < Crit; j++){
            jumlah = jumlah + (arr4[j] * arr3[i][j]);
        }
        SAW[i] = jumlah;
    }

    for (int i=0; i < Alt; i++){
        float kali = 1;
        for (int j=0; j < Crit; j++){
            kali = kali * pow(arr3[i][j], arr4[j]);
        }
        WP[i] = kali;
    }

    for (int i=0; i < Alt; i++){
        WASPAS[i] = 0.5*SAW[i] + 0.5*WP[i];
    }

    cout << endl;

    cout << "WSM" << endl; 
    for (int i=0; i < Alt; i++){
        cout << SAW[i] << endl;
    }

    cout << endl;

    cout << "WPM" << endl; 
    for (int i=0; i < Alt; i++){
        cout << WP[i] << endl;
    }

    cout << endl;

    cout << "WASPAS" << endl;
    for (int i=0; i < Alt; i++){
        cout << WASPAS[i] << endl;
    }

}