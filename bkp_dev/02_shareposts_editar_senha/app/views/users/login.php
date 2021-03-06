<?php require APPROOT . '/views/inc/header.php'; ?>
    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="card card-body bg-light mt-5">
                <?php // Segunda parte da menságem        
                flash('register_success');
                ?>
                <h2>Login</h2>
                <p>Por favor informe suas credenciais</p>                               
                <form action="<?php echo URLROOT; ?>/users/login" method="post">  
                         
                     <!--EMAIL-->
                     <div class="form-group">   
                        <label 
                            for="email">Email: <sup>*</sup>
                        </label>                        
                        <input 
                            type="text" 
                            name="email" 
                            placeholder="Informe seu email",
                            class="form-control form-control-lg <?php echo (!empty($data['email_err'])) ? 'is-invalid' : ''; ?>"                             
                            value="<?php echo $data['email'];?>"
                        >
                        <span class="invalid-feedback">
                            <?php echo $data['email_err']; ?>
                        </span>
                    </div>

                     <!--PASSWORD-->
                     <div class="form-group">   
                        <label 
                            for="password">Senha: <sup>*</sup>
                        </label>                        
                        <input 
                            type="password" 
                            name="password" 
                            placeholder="Informe sua senha",
                            class="form-control form-control-lg <?php echo (!empty($data['password_err'])) ? 'is-invalid' : ''; ?>"                             
                            value="<?php echo $data['password'];?>"
                        >
                        <span class="invalid-feedback">
                            <?php echo $data['password_err']; ?>
                        </span>
                    </div>                     

                    <!--BUTTONS-->
                    <div class="row">
                        <div class="col">
                            <input type="submit" value="Login" class="btn btn-success btn-block">                           
                        </div>
                        <div class="col">
                            <a href="<?php echo URLROOT ;?>/users/register" class="btn btn-light btn-block">Não tem uma conta? Registre-se</a>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col">
                            Esqueceu a senha? clique <a href="<?php echo (URLROOT.'/users/enviasenha');?>">aqui</a>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
<?php require APPROOT . '/views/inc/footer.php'; ?>