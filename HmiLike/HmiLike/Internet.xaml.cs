using HmiLike.Pages;
using System;
using System.Collections.Generic;
using System.Diagnostics;
using System.Linq;
using System.Text;
using System.Windows;
using System.Windows.Controls;
using System.Windows.Data;
using System.Windows.Documents;
using System.Windows.Input;
using System.Windows.Media;
using System.Windows.Media.Imaging;
using System.Windows.Navigation;
using System.Windows.Shapes;


namespace HmiLike
{
    /// <summary>
    /// Interaction logic for Internet.xaml
    /// </summary>
    public partial class Internet : UserControl
    {
        Process process = new Process();
        public Internet()
        {
            InitializeComponent();

            process = System.Diagnostics.Process.Start("osk.exe");
        }

        private void ess_Click(object sender, RoutedEventArgs e)
        {
            Switcher.Switch(new Page1());
            process.Close();
           
        }
    }
}
