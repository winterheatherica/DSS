#include <iostream>

using namespace std;

int krit;
int alt;

float arr1[100];
string arr2[100];
float arr3[100][100];
float arr4[100][100];
float arr5[100][100];
float arr6[100][2];
float arr7[100];
float arr8[100];

float min_s = INT_MAX;
float jumlah_min_s = 0;
float jumlah_1_per_min_s = 0;

float max_q = INT_MIN;

int main (){

    cin >> krit;
    for (int i=0; i < krit; i++){
        cin >> arr1[i] >> arr2[i];
    }

    cin >> alt;
    for (int i=0; i < alt; i++){
        for (int j=0; j < krit; j++){
            cin >> arr3[i][j];
        }
    }

    // for (int i=0; i < alt; i++){
    //     for (int j=0; j < krit; j++){
    //         cout << arr3[i][j] << " ";
    //     }
    //     cout << endl;
    // }

    // cout << endl;

    for (int i=0; i < krit; i++){
        float jumlah_i = 0;
        for (int j=0; j < alt; j++){
            jumlah_i = jumlah_i + arr3[j][i];
        }
        for (int j=0; j < alt; j++){
            arr4[j][i] = arr3[j][i]/jumlah_i;
        }
    }

    // for (int i=0; i < alt; i++){
    //     for (int j=0; j < krit; j++){
    //         cout << arr4[i][j] << " ";
    //     }
    //     cout << endl;
    // }

    // cout << endl;

    for (int i=0; i < alt; i++){
        for (int j=0; j < krit; j++){
            arr5[i][j] = arr4[i][j] * arr1[j];
        }
    }

    // for (int i=0; i < alt; i++){
    //     for (int j=0; j < krit; j++){
    //         cout << arr5[i][j] << " ";
    //     }
    //     cout << endl;
    // }

    // cout << endl;

    for (int i=0; i < alt; i++){
        arr6[i][0] = 0;
        arr6[i][1] = 0;
        for (int j=0; j < krit; j++){
            if (arr2[j] == "b"){
                arr6[i][0] = arr6[i][0] + arr5[i][j];
            } else if (arr2[j] == "c"){
                arr6[i][1] = arr6[i][1] + arr5[i][j];
            }
        }
    }

    // for (int i=0; i < alt; i++){
    //     for (int j=0; j < 2; j++){
    //         cout << arr6[i][j] << " ";
    //     }
    //     cout << endl;
    // }

    // cout << endl;

    for (int i=0; i < alt; i++){
        if (arr6[i][1] < min_s){
            min_s = arr6[i][1];
        }
    }

    for (int i=0; i < alt; i++){
        jumlah_min_s = jumlah_min_s + arr6[i][1];
        jumlah_1_per_min_s = jumlah_1_per_min_s + (min_s/arr6[i][1]);
    }

    for (int i=0; i < alt; i++){
        arr7[i] = arr6[i][0] + (min_s*jumlah_min_s)/(arr6[i][1]*jumlah_1_per_min_s);
    }

    // for (int i=0; i < alt; i++){
    //     cout << arr7[i] << endl;
    // }

    // cout << endl;

    for (int i=0; i < alt; i++){
        if (arr7[i] > max_q){
            max_q = arr7[i];
        }
    }

    for (int i=0; i < alt; i++){
        arr8[i] = arr7[i]/max_q;
    }

    for (int i=0; i < alt; i++){
        cout << arr8[i] << " ";
    }

}