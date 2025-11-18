import React from 'react';
import {
    Box,
    Grid,
    Stat,
    StatLabel,
    StatNumber,
    StatHelpText,
    StatArrow,
    useColorModeValue,
    Heading,
    Table,
    Thead,
    Tbody,
    Tr,
    Th,
    Td,
    Badge,
    Icon,
    Flex,
    Text,
    VStack,
} from '@chakra-ui/react';
import { Home, Users, DollarSign, TrendingUp, Target, Award } from 'lucide-react';

const StatCard = ({ label, value, change, icon, color }) => {
    const bgColor = useColorModeValue('white', 'gray.800');

    return (
        <Box bg={bgColor} p={6} borderRadius="xl" shadow="sm">
            <Stat>
                <Flex justify="space-between" align="center" mb={4}>
                    <Box p={3} bg={`${color}.50`} borderRadius="lg">
                        <Icon as={icon} color={`${color}.600`} fontSize="24px" />
                    </Box>
                </Flex>
                <StatLabel color="gray.600" fontSize="sm">
                    {label}
                </StatLabel>
                <StatNumber fontSize="3xl" fontWeight="bold">
                    {value}
                </StatNumber>
                {change !== null && (
                    <StatHelpText>
                        <StatArrow type={change > 0 ? 'increase' : 'decrease'} />
                        {Math.abs(change)}% from last month
                    </StatHelpText>
                )}
            </Stat>
        </Box>
    );
};

const RealtorDashboard = () => {
    const bgColor = useColorModeValue('white', 'gray.800');

    const stats = [
        { label: 'My Properties', value: '34', change: 12, icon: Home, color: 'blue' },
        { label: 'Active Leads', value: '12', change: 8, icon: Users, color: 'green' },
        { label: 'Total Commission', value: '$69,000', change: 23, icon: DollarSign, color: 'purple' },
        { label: 'This Month Sales', value: '$450K', change: 15, icon: TrendingUp, color: 'orange' },
        { label: 'Deals Closed', value: '45', change: null, icon: Target, color: 'teal' },
        { label: 'Conversion Rate', value: '22%', change: 5, icon: Award, color: 'pink' },
    ];

    const recentActivity = [
        {
            id: 1,
            type: 'lead',
            title: 'New lead assigned',
            description: 'Amanda Wilson - Looking to buy in Downtown',
            time: '2 hours ago',
            status: 'new',
        },
        {
            id: 2,
            type: 'property',
            title: 'Property viewing scheduled',
            description: '123 Main St with John Smith',
            time: '5 hours ago',
            status: 'scheduled',
        },
        {
            id: 3,
            type: 'sale',
            title: 'Deal closed',
            description: '456 Oak Ave - $325,000',
            time: '1 day ago',
            status: 'completed',
        },
        {
            id: 4,
            type: 'lead',
            title: 'Lead status updated',
            description: 'Thomas Brown moved to qualified',
            time: '2 days ago',
            status: 'updated',
        },
    ];

    const upcomingTasks = [
        {
            id: 1,
            task: 'Property showing at 123 Main St',
            client: 'John Smith',
            time: 'Today at 2:00 PM',
            priority: 'high',
        },
        {
            id: 2,
            task: 'Follow up call with Amanda Wilson',
            client: 'Amanda Wilson',
            time: 'Today at 4:00 PM',
            priority: 'medium',
        },
        {
            id: 3,
            task: 'Contract review meeting',
            client: 'Emily Davis',
            time: 'Tomorrow at 10:00 AM',
            priority: 'high',
        },
        {
            id: 4,
            task: 'Open house preparation',
            client: '789 Pine Rd',
            time: 'Tomorrow at 3:00 PM',
            priority: 'low',
        },
    ];

    return (
        <Box>
            <Heading mb={8}>My Dashboard</Heading>

            <Grid templateColumns="repeat(auto-fit, minmax(250px, 1fr))" gap={6} mb={8}>
                {stats.map((stat, index) => (
                    <StatCard key={index} {...stat} />
                ))}
            </Grid>

            <Grid templateColumns="repeat(auto-fit, minmax(400px, 1fr))" gap={6}>
                {/* Recent Activity */}
                <Box bg={bgColor} p={6} borderRadius="xl" shadow="sm">
                    <Heading size="md" mb={6}>
                        Recent Activity
                    </Heading>
                    <VStack spacing={4} align="stretch">
                        {recentActivity.map((activity) => (
                            <Box key={activity.id} p={3} borderRadius="lg" bg="gray.50" _dark={{ bg: 'gray.700' }}>
                                <Flex justify="space-between" align="start" mb={1}>
                                    <Text fontWeight="semibold" fontSize="sm">
                                        {activity.title}
                                    </Text>
                                    <Badge
                                        colorScheme={
                                            activity.status === 'new'
                                                ? 'purple'
                                                : activity.status === 'completed'
                                                ? 'green'
                                                : 'blue'
                                        }
                                        fontSize="xs"
                                    >
                                        {activity.status}
                                    </Badge>
                                </Flex>
                                <Text fontSize="sm" color="gray.600" mb={1}>
                                    {activity.description}
                                </Text>
                                <Text fontSize="xs" color="gray.500">
                                    {activity.time}
                                </Text>
                            </Box>
                        ))}
                    </VStack>
                </Box>

                {/* Upcoming Tasks */}
                <Box bg={bgColor} p={6} borderRadius="xl" shadow="sm">
                    <Heading size="md" mb={6}>
                        Upcoming Tasks
                    </Heading>
                    <VStack spacing={4} align="stretch">
                        {upcomingTasks.map((task) => (
                            <Box key={task.id} p={3} borderRadius="lg" bg="gray.50" _dark={{ bg: 'gray.700' }}>
                                <Flex justify="space-between" align="start" mb={1}>
                                    <Text fontWeight="semibold" fontSize="sm">
                                        {task.task}
                                    </Text>
                                    <Badge
                                        colorScheme={
                                            task.priority === 'high'
                                                ? 'red'
                                                : task.priority === 'medium'
                                                ? 'orange'
                                                : 'gray'
                                        }
                                        fontSize="xs"
                                    >
                                        {task.priority}
                                    </Badge>
                                </Flex>
                                <Text fontSize="sm" color="gray.600" mb={1}>
                                    Client: {task.client}
                                </Text>
                                <Text fontSize="xs" color="gray.500">
                                    {task.time}
                                </Text>
                            </Box>
                        ))}
                    </VStack>
                </Box>
            </Grid>
        </Box>
    );
};

export default RealtorDashboard;
