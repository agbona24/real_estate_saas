import React, { useState } from 'react';
import {
    Box,
    Button,
    FormControl,
    FormLabel,
    Input,
    Stack,
    Text,
    Heading,
    Link,
    useColorModeValue,
    InputGroup,
    InputRightElement,
    IconButton,
    Alert,
    AlertIcon,
} from '@chakra-ui/react';
import { Link as RouterLink, useNavigate } from 'react-router-dom';
import { Eye, EyeOff } from 'lucide-react';
import { useAuthStore } from '../../stores/authStore';

const Login = () => {
    const [email, setEmail] = useState('');
    const [password, setPassword] = useState('');
    const [showPassword, setShowPassword] = useState(false);
    const [error, setError] = useState('');
    const [loading, setLoading] = useState(false);

    const { setAuth } = useAuthStore();
    const navigate = useNavigate();

    const bgColor = useColorModeValue('white', 'gray.800');

    const handleSubmit = async (e) => {
        e.preventDefault();
        setLoading(true);
        setError('');

        // Demo login - replace with actual API call
        setTimeout(() => {
            if (email && password) {
                // Demo user based on email
                let role = 'client';
                if (email.includes('admin@')) role = 'super_admin';
                else if (email.includes('agency@')) role = 'agency_admin';
                else if (email.includes('realtor@')) role = 'realtor';

                const user = {
                    id: 1,
                    first_name: 'John',
                    last_name: 'Doe',
                    email: email,
                    role: role,
                };

                setAuth(user, 'demo-token-123');
                navigate('/dashboard');
            } else {
                setError('Invalid credentials');
            }
            setLoading(false);
        }, 1000);
    };

    return (
        <Box bg={bgColor} p={8} borderRadius="xl" shadow="lg">
            <Stack spacing={6}>
                <Box textAlign="center">
                    <Heading size="lg" mb={2}>
                        Sign in to your account
                    </Heading>
                    <Text color="gray.600">
                        Welcome back! Please enter your details
                    </Text>
                </Box>

                {error && (
                    <Alert status="error" borderRadius="md">
                        <AlertIcon />
                        {error}
                    </Alert>
                )}

                <form onSubmit={handleSubmit}>
                    <Stack spacing={4}>
                        <FormControl isRequired>
                            <FormLabel>Email address</FormLabel>
                            <Input
                                type="email"
                                value={email}
                                onChange={(e) => setEmail(e.target.value)}
                                placeholder="you@example.com"
                            />
                        </FormControl>

                        <FormControl isRequired>
                            <FormLabel>Password</FormLabel>
                            <InputGroup>
                                <Input
                                    type={showPassword ? 'text' : 'password'}
                                    value={password}
                                    onChange={(e) => setPassword(e.target.value)}
                                    placeholder="••••••••"
                                />
                                <InputRightElement>
                                    <IconButton
                                        variant="ghost"
                                        size="sm"
                                        icon={showPassword ? <EyeOff size={18} /> : <Eye size={18} />}
                                        onClick={() => setShowPassword(!showPassword)}
                                        aria-label="Toggle password visibility"
                                    />
                                </InputRightElement>
                            </InputGroup>
                        </FormControl>

                        <Button
                            type="submit"
                            colorScheme="brand"
                            size="lg"
                            isLoading={loading}
                        >
                            Sign in
                        </Button>
                    </Stack>
                </form>

                <Stack spacing={2} fontSize="sm" textAlign="center">
                    <Link as={RouterLink} to="/forgot-password" color="brand.600">
                        Forgot your password?
                    </Link>
                    <Text>
                        Don't have an account?{' '}
                        <Link as={RouterLink} to="/register" color="brand.600" fontWeight="semibold">
                            Sign up
                        </Link>
                    </Text>
                </Stack>

                <Box p={4} bg="blue.50" borderRadius="md" fontSize="sm">
                    <Text fontWeight="semibold" mb={2}>Demo Credentials:</Text>
                    <Text>Super Admin: admin@example.com / password</Text>
                    <Text>Agency: agency@example.com / password</Text>
                    <Text>Realtor: realtor@example.com / password</Text>
                    <Text>Client: client@example.com / password</Text>
                </Box>
            </Stack>
        </Box>
    );
};

export default Login;
