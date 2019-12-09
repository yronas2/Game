using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using UnityEngine.UI;
using UnityEngine.Networking;

public class Registration : MonoBehaviour
{
    public InputField nameField;
    public InputField passwordField;

    public Button submitButton;

    readonly string getURL = "http://localhost/sqlconnect/register.php";

    public void CallRegister()
    {
        StartCoroutine(Register());

    }
    IEnumerator Register()
    {
        WWWForm form = new WWWForm();
        form.AddField("name", nameField.text);
        form.AddField("password", passwordField.text);
        UnityWebRequest www = UnityWebRequest.Post(getURL, form);
        {
            yield return www.SendWebRequest();
            if (www.downloadHandler.text == "0")
            {
                Debug.Log("User created successfully.");
                UnityEngine.SceneManagement.SceneManager.LoadScene(0);

            }

            {
                Debug.Log("User creation failed. Error #" + www);
            }
        }
    }
    public void VerifyInputs()
    {
        submitButton.interactable = (nameField.text.Length >= 8 && passwordField.text.Length >= 8);
    }
    
}
